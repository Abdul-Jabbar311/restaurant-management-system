@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')

@php
    $cart = session('cart', []);

    $grandTotal = 0;

    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }

    $tax = $grandTotal * 0.05;
    $delivery = 200;
    $total = $grandTotal + $tax + $delivery;
@endphp

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold mb-8">
        Checkout
    </h1>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- Customer Details -->

        <div class="lg:col-span-2">

            <div class="bg-white rounded-xl shadow p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Customer Information
                </h2>

                <form action="{{ route('place.order') }}" method="POST">

                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>

                            <label class="block mb-2 font-semibold">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="w-full border rounded-lg px-4 py-3"
                                required>

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="w-full border rounded-lg px-4 py-3"
                                required>

                        </div>

                    </div>

                    <div class="mt-6">

                        <label class="block mb-2 font-semibold">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="w-full border rounded-lg px-4 py-3">

                    </div>

                    <div class="mt-6">

                        <label class="block mb-2 font-semibold">
                            Delivery Address
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            class="w-full border rounded-lg px-4 py-3"
                            required></textarea>

                    </div>

                    <div class="mt-6">

                        <label class="block mb-2 font-semibold">
                            Order Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="3"
                            class="w-full border rounded-lg px-4 py-3"
                            placeholder="Extra spicy, no onions, etc."></textarea>

                    </div>
                                        <div class="mt-6">

                        <label class="block mb-4 font-semibold">
                            Payment Method
                        </label>

                        <div class="space-y-3">

                            <label class="flex items-center gap-3">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="Cash"
                                    checked>

                                Cash on Delivery

                            </label>

                            <label class="flex items-center gap-3">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="Card">

                                Credit / Debit Card

                            </label>

                            <label class="flex items-center gap-3">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="JazzCash">

                                JazzCash

                            </label>

                            <label class="flex items-center gap-3">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="EasyPaisa">

                                EasyPaisa

                            </label>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="mt-8 w-full bg-orange-600 hover:bg-orange-700 text-white py-4 rounded-lg font-semibold">

                        Place Order

                    </button>

                </form>

            </div>

        </div>

        <!-- Order Summary -->

        <div>

            <div class="bg-white rounded-xl shadow p-6 sticky top-6">

                <h2 class="text-2xl font-bold mb-6">
                    Order Summary
                </h2>

                <form action="{{ route('coupon.apply') }}" method="POST" class="mb-5">

                    @csrf

                    <div class="flex gap-2">

                        <input
                            type="text"
                            name="code"
                            placeholder="Coupon Code"
                            class="border rounded px-3 py-2 flex-1">

                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-4 rounded">

                            Apply

                        </button>

                    </div>

                </form>
                                <div class="flex justify-between mb-4">

                    <span>Subtotal</span>

                    <span>
                        Rs. {{ number_format($grandTotal, 2) }}
                    </span>

                </div>

                <div class="flex justify-between mb-4">

                    <span>Tax</span>

                    <span>
                        Rs. {{ number_format($tax, 2) }}
                    </span>

                </div>

                <div class="flex justify-between mb-4">

                    <span>Delivery</span>

                    <span>
                        Rs. {{ number_format($delivery, 2) }}
                    </span>

                </div>

                <hr class="my-5">

                <div class="flex justify-between text-2xl font-bold">

                    <span>Total</span>

                    <span class="text-orange-600">

                        Rs. {{ number_format($total, 2) }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection