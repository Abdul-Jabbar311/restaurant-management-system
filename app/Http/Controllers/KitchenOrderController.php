<?php

namespace App\Http\Controllers;

use App\Models\KitchenOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
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
        'orderItems.menuItem'
    ])
    ->whereIn('status', [
        'Pending',
        'Preparing',
        'Ready'
    ])
    ->latest()
    ->paginate(10);

    return view('kitchen-orders.index', compact('kitchenOrders'));
}

    /**
     * Show create form
     */
    public function create()
    {
        $orders = Order::all();

        return view('kitchen-orders.create', compact('orders'));
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
            ->with('success', 'Kitchen Order Created Successfully.');
    }

    /**
     * Show kitchen order details
     */
    public function show(KitchenOrder $kitchenOrder)
    {
        return view('kitchen-orders.show', compact('kitchenOrder'));
    }

    /**
     * Show edit form
     */
    public function edit(KitchenOrder $kitchenOrder)
    {
        $orders = Order::all();

        return view(
            'kitchen-orders.edit',
            compact('kitchenOrder', 'orders')
        );
    }

    /**
     * Update kitchen order
     */
    public function update(Request $request, KitchenOrder $kitchenOrder)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required',
            'started_at' => 'nullable',
            'completed_at' => 'nullable',
        ]);

        $kitchenOrder->update($validated);

        return redirect()
            ->route('kitchen-orders.index')
            ->with('success', 'Kitchen Order Updated Successfully.');
    }

    /**
     * Delete kitchen order
     */
    public function destroy(KitchenOrder $kitchenOrder)
    {
        $kitchenOrder->delete();

        return redirect()
            ->route('kitchen-orders.index')
            ->with('success', 'Kitchen Order Deleted Successfully.');
    }

    /**
     * Update kitchen order status
     */
  public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:Pending,Preparing,Ready',
    ]);

    $order->update([
        'status' => $request->status,
    ]);

    // Automatically notify all Waiters when order is Ready
    if ($request->status === 'Ready') {

        $waiters = User::whereHas('role', function ($query) {
            $query->where('name', 'Waiter');
        })->get();

        foreach ($waiters as $waiter) {

            Notification::create([
                'user_id' => $waiter->id,
                'title' => 'Order Ready',
                'message' => 'Order ' . $order->order_number .
                    ' is ready for delivery. Table: ' .
                    ($order->restaurantTable?->table_number ?? 'N/A'),
                'is_read' => false,
            ]);
        }
    }

    return redirect()
        ->route('kitchen-orders.index')
        ->with('success', 'Order status updated successfully.');
}
}