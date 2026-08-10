<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\RestaurantTable;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\Contact;
use App\Models\Feedback;

class FrontendController extends Controller
{
    public function home()
    {
        $categories = Category::where('is_active', true)->get();

        // Show only featured & available menu items
        $featuredItems = MenuItem::where('is_available', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home', compact(
            'categories',
            'featuredItems'
        ));
    }

    public function menu(Request $request)
    {
        $categories = Category::where('is_active', true)->get();

        $query = MenuItem::where('is_available', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menuItems = $query->latest()->paginate(12);

        return view('frontend.menu', compact(
            'categories',
            'menuItems'
        ));
    }
        public function category(Category $category)
    {
        $menuItems = $category->menuItems()
            ->where('is_available', true)
            ->latest()
            ->paginate(12);

        return view('frontend.category', compact(
            'category',
            'menuItems'
        ));
    }

    public function show(MenuItem $menuItem)
    {
        $relatedItems = MenuItem::where('category_id', $menuItem->category_id)
            ->where('id', '!=', $menuItem->id)
            ->where('is_available', true)
            ->take(4)
            ->get();

        return view('frontend.show', compact(
            'menuItem',
            'relatedItems'
        ));
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

   public function placeOrder(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'phone'   => 'required|string|max:20',
        'email'   => 'nullable|email',
        'address' => 'required|string',
        'notes'   => 'nullable|string',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()
            ->route('cart')
            ->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {

        // Create customer
        $customer = Customer::firstOrCreate(
            [
                'phone' => $request->phone,
            ],
            [
                'name'    => $request->name,
                'email'   => $request->email,
                'address' => $request->address,
            ]
        );

        // Calculate subtotal
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Additional charges
        $tax = $subtotal * 0.05;
        $delivery = 200;

        // Final amount
        $total = $subtotal + $tax + $delivery;

        // Use scanned table or default table 1
        $tableId = session('table_id', 1);

        // Create order
        $order = Order::create([
            'restaurant_table_id' => $tableId,
            'customer_id'         => $customer->id,
            'waiter_id'           => 1,

            // Temporary value (required because order_number cannot be empty)
            'order_number'        => 'TEMP',

            'status'              => 'Pending',
            'payment_status'      => 'Unpaid',
            'total_amount'        => $total,
            'notes'               => $request->notes,
        ]);

        // Mark scanned table as occupied
        $restaurantTable = \App\Models\RestaurantTable::find(session('table_id'));

        if ($restaurantTable) {
            $restaurantTable->update([
                'status' => 'Occupied'
            ]);
        }

        // Generate professional order number
        $order->update([
            'order_number' => 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
        ]);

        // Save order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'menu_item_id' => $item['id'],
                'quantity'     => $item['quantity'],
                'unit_price'   => $item['price'],
                'subtotal'     => $item['price'] * $item['quantity'],
            ]);
        }

        DB::commit();

        session()->forget('cart');

        return redirect()
            ->route('track.order', $order)
            ->with('success', 'Order placed successfully!');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}
       public function trackOrder(Order $order)
{
    $order->load([
        'customer',
        'restaurantTable',
        'orderItems.menuItem'
    ]);

    return view('frontend.track-order', compact('order'));
}

    public function reservation()
    {
        return view('frontend.reservation');
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'nullable|email',
            'reservation_date'  => 'required|date',
            'reservation_time'  => 'required',
            'number_of_guests'  => 'required|integer|min:1',
            'special_request'   => 'nullable|string',
        ]);

        // Create customer if phone doesn't already exist
        $customer = Customer::firstOrCreate(
            [
                'phone' => $request->phone,
            ],
            [
                'name'    => $request->name,
                'email'   => $request->email,
                'address' => null,
            ]
        );

        // Find a free table
        $table = RestaurantTable::where('status', 'Available')
            ->where('capacity', '>=', $request->number_of_guests)
            ->orderBy('capacity')
            ->first();

        if (!$table) {
            return back()->with('error', 'No table available for this reservation.');
        }

        Reservation::create([
            'customer_id'         => $customer->id,
            'restaurant_table_id' => $table->id,
            'reservation_date'    => $request->reservation_date,
            'reservation_time'    => $request->reservation_time,
            'number_of_guests'    => $request->number_of_guests,
            'status'              => 'Pending',
            'special_request'     => $request->special_request,
        ]);

        return redirect()
            ->route('reservation.front')
            ->with('success', 'Reservation submitted successfully!');
    }
        public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function feedback()
    {
        return view('frontend.feedback');
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $customer = Customer::firstOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'name'    => $request->name,
                'phone'   => '',
                'address' => '',
            ]
        );

        Feedback::create([
            'customer_id' => $customer->id,
            'rating'      => $request->rating,
            'comment'     => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }
public function scanTable($tableNumber)
{
    $table = RestaurantTable::where('table_number', $tableNumber)->firstOrFail();

    session([
        'table_id' => $table->id,
        'table_number' => $table->table_number,
    ]);

    return view('frontend.table-welcome', compact('table'));
}

    public function myOrders()
    {
        return view('frontend.my-orders');
    }
        public function searchOrders(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $customer = Customer::where('phone', $request->phone)->first();

        if (!$customer) {
            return back()->with('error', 'No customer found.');
        }

        $orders = Order::where('customer_id', $customer->id)
            ->latest()
            ->get();

        return view('frontend.my-orders', compact('orders', 'customer'));
    }
    public function waiter()
{
    $orders = Order::with([
        'customer',
        'restaurantTable',
        'orderItems.menuItem'
    ])
    ->where('status', 'Ready')
    ->latest()
    ->get();

    $deliveredToday = Order::where('status', 'Delivered')
        ->whereDate('updated_at', today())
        ->count();

    return view('frontend.waiter', compact(
        'orders',
        'deliveredToday'
    ));
}
    }