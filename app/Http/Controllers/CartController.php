<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
public function index()
{
    $cart = session()->get('cart', []);

    $grandTotal = 0;

    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }

    return view('frontend.cart', compact('cart', 'grandTotal'));
}

  public function add(MenuItem $menuItem)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$menuItem->id])) {

        $cart[$menuItem->id]['quantity']++;

    } else {

        $cart[$menuItem->id] = [
            'id' => $menuItem->id,
            'name' => $menuItem->name,
            'price' => $menuItem->price,
            'image' => $menuItem->image,
            'quantity' => 1,
        ];

    }

    session()->put('cart', $cart);

    return redirect()->route('cart')
        ->with('success', 'Item added successfully.');
}
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $quantity = max(1, (int) $request->quantity);

            $cart[$id]['quantity'] = $quantity;

            session()->put('cart', $cart);

        }

        return redirect()->route('cart');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);

        }

        return redirect()
            ->route('cart')
            ->with('success', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()
            ->route('cart')
            ->with('success', 'Cart cleared.');
    }

   public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon' => 'required'
    ]);

    $coupon = \App\Models\Coupon::where('code', $request->coupon)
        ->where('is_active', 1)
        ->whereDate('expiry_date', '>=', now())
        ->first();

    if (!$coupon) {
        return back()->with('error', 'Invalid or expired coupon.');
    }

    session([
        'coupon' => [
            'code' => $coupon->code,
            'discount' => $coupon->discount_percent,
        ]
    ]);

    return back()->with('success', 'Coupon applied successfully!');
}
}