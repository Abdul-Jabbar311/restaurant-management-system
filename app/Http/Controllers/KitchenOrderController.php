<?php

namespace App\Http\Controllers;

use App\Models\KitchenOrder;
use App\Models\Order;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitchenOrderController extends Controller
{
    /**
     * Display all kitchen orders
     */
    public function index()
    {
        $kitchenOrders = Order::with([
            'customer',
            'restaurantTable',
            'orderItems.menuItem.ingredients'
        ])
        ->whereIn('status', [
            'Pending',
            'Preparing',
            'Ready'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'kitchen-orders.index',
            compact('kitchenOrders')
        );
    }


    /**
     * Show create form
     */
    public function create()
    {
        $orders = Order::all();

        return view(
            'kitchen-orders.create',
            compact('orders')
        );
    }


    /**
     * Store kitchen order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required',
            'started_at' => 'nullable',
            'completed_at' => 'nullable',
        ]);

        KitchenOrder::create($validated);

        return redirect()
            ->route('kitchen-orders.index')
            ->with(
                'success',
                'Kitchen Order Created Successfully.'
            );
    }


    /**
     * Show kitchen order details
     */
    public function show(KitchenOrder $kitchenOrder)
    {
        $kitchenOrder->load([
            'order.orderItems.menuItem.ingredients'
        ]);

        return view(
            'kitchen-orders.show',
            compact('kitchenOrder')
        );
    }


    /**
     * Show edit form
     */
    public function edit(KitchenOrder $kitchenOrder)
    {
        $orders = Order::all();

        return view(
            'kitchen-orders.edit',
            compact(
                'kitchenOrder',
                'orders'
            )
        );
    }


    /**
     * Update kitchen order
     */
    public function update(
        Request $request,
        KitchenOrder $kitchenOrder
    ) {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required',
            'started_at' => 'nullable',
            'completed_at' => 'nullable',
        ]);

        $kitchenOrder->update($validated);

        return redirect()
            ->route('kitchen-orders.index')
            ->with(
                'success',
                'Kitchen Order Updated Successfully.'
            );
    }


    /**
     * Delete kitchen order
     */
    public function destroy(KitchenOrder $kitchenOrder)
    {
        $kitchenOrder->delete();

        return redirect()
            ->route('kitchen-orders.index')
            ->with(
                'success',
                'Kitchen Order Deleted Successfully.'
            );
    }


    /**
     * Update order status.
     *
     * When an order changes from Pending to Preparing:
     *
     * 1. Get all order items.
     * 2. Get the ingredients for each menu item.
     * 3. Calculate required ingredient quantity.
     * 4. Check stock availability.
     * 5. Deduct stock.
     * 6. Create Stock Out transaction.
     *
     * Stock is deducted only once.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Preparing,Ready',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Only deduct stock when changing Pending → Preparing
        |--------------------------------------------------------------------------
        */

        if (
            $order->status === 'Pending' &&
            $request->status === 'Preparing'
        ) {

            try {

                DB::transaction(function () use ($order) {

                    /*
                    |--------------------------------------------------------------------------
                    | Load order items and their recipes
                    |--------------------------------------------------------------------------
                    */

                    $order->load([
                        'orderItems.menuItem.ingredients'
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | First check ALL ingredients
                    |--------------------------------------------------------------------------
                    | We do this before deducting anything.
                    | This prevents partial stock deduction.
                    |--------------------------------------------------------------------------
                    */

                    foreach ($order->orderItems as $orderItem) {

                        $menuItem = $orderItem->menuItem;

                        if (!$menuItem) {
                            continue;
                        }


                        foreach ($menuItem->ingredients as $ingredient) {

                            /*
                            |--------------------------------------------------------------------------
                            | Recipe quantity for ONE menu item
                            |--------------------------------------------------------------------------
                            */

                            $recipeQuantity =
                                (float) $ingredient->pivot->quantity;


                            /*
                            |--------------------------------------------------------------------------
                            | Ordered menu quantity
                            |--------------------------------------------------------------------------
                            */

                            $orderedQuantity =
                                (float) $orderItem->quantity;


                            /*
                            |--------------------------------------------------------------------------
                            | Total ingredient required
                            |--------------------------------------------------------------------------
                            */

                            $requiredQuantity =
                                $recipeQuantity * $orderedQuantity;


                            /*
                            |--------------------------------------------------------------------------
                            | Check stock
                            |--------------------------------------------------------------------------
                            */

                            if (
                                (float) $ingredient->stock_quantity
                                < $requiredQuantity
                            ) {

                                throw new \Exception(
                                    'Not enough stock for ingredient: ' .
                                    $ingredient->name .
                                    '. Required: ' .
                                    $requiredQuantity .
                                    ' ' .
                                    $ingredient->unit .
                                    ', Available: ' .
                                    $ingredient->stock_quantity .
                                    ' ' .
                                    $ingredient->unit
                                );
                            }
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Now deduct stock
                    |--------------------------------------------------------------------------
                    */

                    foreach ($order->orderItems as $orderItem) {

                        $menuItem = $orderItem->menuItem;

                        if (!$menuItem) {
                            continue;
                        }


                        foreach ($menuItem->ingredients as $ingredient) {

                            $recipeQuantity =
                                (float) $ingredient->pivot->quantity;

                            $orderedQuantity =
                                (float) $orderItem->quantity;

                            $requiredQuantity =
                                $recipeQuantity * $orderedQuantity;


                            /*
                            |--------------------------------------------------------------------------
                            | Deduct ingredient stock
                            |--------------------------------------------------------------------------
                            */

                            $ingredient->decrement(
                                'stock_quantity',
                                $requiredQuantity
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | Create inventory transaction
                            |--------------------------------------------------------------------------
                            */

                            $ingredient->inventoryTransactions()->create([
                                'transaction_type' => 'Stock Out',

                                'quantity' => $requiredQuantity,

                                'reference' =>
                                    'Order #' .
                                    $order->order_number,

                                'notes' =>
                                    'Used for preparing order #' .
                                    $order->order_number,
                            ]);
                        }
                    }
                });


            } catch (\Exception $e) {

                return back()->with(
                    'error',
                    $e->getMessage()
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Update order status
        |--------------------------------------------------------------------------
        */

        $order->update([
            'status' => $request->status,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Notify waiters when order becomes Ready
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'Ready') {

            $waiters = User::whereHas(
                'role',
                function ($query) {
                    $query->where('name', 'Waiter');
                }
            )->get();


            foreach ($waiters as $waiter) {

                Notification::create([
                    'user_id' => $waiter->id,

                    'title' => 'Order Ready',

                    'message' =>
                        'Order ' .
                        $order->order_number .
                        ' is ready for delivery. Table: ' .
                        ($order->restaurantTable?->table_number ?? 'N/A'),

                    'is_read' => false,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('kitchen-orders.index')
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }
}