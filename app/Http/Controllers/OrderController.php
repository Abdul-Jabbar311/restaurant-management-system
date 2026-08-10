<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'customer',
            'restaurantTable'
        ])
        ->latest()
        ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();

        $tables = RestaurantTable::where('status', 'Available')->get();

        return view('orders.create', compact(
            'customers',
            'tables'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $table = RestaurantTable::findOrFail(
            $request->restaurant_table_id
        );

        $order = Order::create([
            'restaurant_table_id' => $request->restaurant_table_id,
            'customer_id' => $request->customer_id,
            'waiter_id' => auth()->id(),
            'order_number' => 'ORD-' . time(),
            'total_amount' => $request->total_amount,
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
            'notes' => null,
        ]);

        // Mark table as occupied

        $table->update([
            'status' => 'Occupied'
        ]);

        ActivityLogService::log(
            'Create',
            'Orders',
            'Created Order #' . $order->id
        );

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order Created Successfully.');
    }

    public function show(Order $order)
    {
        $order->load([
            'customer',
            'restaurantTable',
            'orderItems.menuItem'
        ]);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();

        $tables = RestaurantTable::all();

        return view('orders.edit', compact(
            'order',
            'customers',
            'tables'
        ));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required',
        ]);

        $order->update([
            'restaurant_table_id' => $request->restaurant_table_id,
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
        ]);

        ActivityLogService::log(
            'Update',
            'Orders',
            'Updated Order #' . $order->id
        );

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order Updated Successfully.');
    }

    public function updateStatus(Order $order)
{
    switch ($order->status) {

        case 'Pending':
            $order->status = 'Preparing';
            break;

        case 'Preparing':
            $order->status = 'Ready';
            break;

        case 'Ready':
            $order->status = 'Delivered';
            break;

        default:
            break;
    }

    $order->save();

    ActivityLogService::log(
        'Update',
        'Orders',
        'Changed status of Order #' .
        $order->id .
        ' to ' .
        $order->status
    );

    return back()->with(
        'success',
        'Order status updated.'
    );
}
    public function waiterOrders()
    {
        $orders = Order::with([
            'customer',
            'restaurantTable',
            'orderItems.menuItem'
        ])
        ->where('status', 'Ready')
        ->latest()
        ->paginate(10);

        $deliveredToday = Order::whereDate(
            'updated_at',
            today()
        )
        ->where('status', 'Delivered')
        ->count();

        return view(
            'orders.waiter',
            compact(
                'orders',
                'deliveredToday'
            )
        );
    }



    public function destroy(Order $order)
    {
        ActivityLogService::log(
            'Delete',
            'Orders',
            'Deleted Order #' . $order->id
        );

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with(
                'success',
                'Order Deleted Successfully.'
            );
    }

   public function deliver(Order $order)
{
    $order->update([
        'status' => 'Delivered'
    ]);

    if ($order->restaurantTable) {
        $order->restaurantTable->update([
            'status' => 'Available'
        ]);
    }

    ActivityLogService::log(
        'Update',
        'Orders',
        'Delivered Order #' . $order->id
    );

    return redirect()
        ->route('waiter.dashboard')
        ->with(
            'success',
            'Order delivered successfully.'
        );
}
   public function markAsPaid(Order $order)
{
    $order->update([
        'payment_status' => 'Paid'
    ]);

    ActivityLogService::log(
        'Update',
        'Orders',
        'Marked Order #' . $order->id . ' as Paid'
    );

    return back()->with(
        'success',
        'Order marked as paid successfully.'
    );
}
public function markPaid(Order $order)
{
    $order->update([
        'payment_status' => 'Paid',
    ]);

    ActivityLogService::log(
        'Update',
        'Orders',
        'Marked Order #' . $order->id . ' as Paid'
    );

    return back()->with(
        'success',
        'Payment marked as Paid successfully.'
    );
}

}
