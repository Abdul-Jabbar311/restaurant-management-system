@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold mb-8">
        Your Cart
    </h1>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- Cart Items -->
        <div class="lg:col-span-2">

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="p-4 text-left">Item</th>
                            <th class="p-4 text-center">Price</th>
                            <th class="p-4 text-center">Quantity</th>
                            <th class="p-4 text-center">Total</th>
                            <th class="p-4 text-center">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                    @if(count($cart))

                        @foreach($cart as $item)

                        <tr class="border-t">

                            <td class="p-4">

                                <div class="flex items-center gap-4">

                                    @if($item['image'])
                                        <img
                                            src="{{ asset('storage/'.$item['image']) }}"
                                            class="w-20 h-20 rounded-lg object-cover">
                                    @else
                                        <img
                                            src="https://placehold.co/90x90"
                                            class="w-20 h-20 rounded-lg object-cover">
                                    @endif

                                    <div>
                                        <h3 class="font-bold">
                                            {{ $item['name'] }}
                                        </h3>
                                    </div>

                                </div>

                            </td>

                            <td class="text-center">
                                Rs. {{ number_format($item['price'],2) }}
                            </td>

                            <td class="text-center">

                                <form
                                    action="{{ route('cart.update',$item['id']) }}"
                                    method="POST"
                                    class="flex justify-center gap-2">

                                    @csrf

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        class="border rounded-lg w-20 px-3 py-2 text-center">

                                    <button
                                        class="bg-blue-600 text-white px-3 rounded">

                                        Update

                                    </button>

                                </form>

                            </td>

                            <td class="text-center font-semibold">
                                Rs. {{ number_format($item['price'] * $item['quantity'],2) }}
                            </td>

                            <td class="text-center">

                                <form
                                    action="{{ route('cart.remove',$item['id']) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                                        Remove

                                    </button>

                                </form>

                            </td>

                        </tr>
                                                @endforeach

                    @else

                        <tr>

                            <td colspan="5" class="text-center py-8 text-gray-500">

                                Your cart is empty.

                            </td>

                        </tr>

                    @endif

                    </tbody>

                </table>

            </div>

        </div>


        <!-- Summary -->

        <div>

            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-2xl font-bold mb-6">

                    Order Summary

                </h2>


                <div class="flex justify-between mb-4">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        Rs. {{ number_format($grandTotal,2) }}
                    </span>

                </div>


                @php

                    $discount = 0;

                    if(session()->has('coupon')){

                        $discount = ($grandTotal * session('coupon.discount')) / 100;

                    }

                    $tax = ($grandTotal - $discount) * 0.05;

                    $delivery = 200;

                    $total = ($grandTotal - $discount) + $tax + $delivery;

                @endphp


                @if(session()->has('coupon'))

                <div class="flex justify-between mb-4">

                    <span>
                        Discount ({{ session('coupon.discount') }}%)
                    </span>


                    <span class="text-green-600">

                        - Rs. {{ number_format($discount,2) }}

                    </span>

                </div>

                @endif
                
                <div class="flex justify-between mb-4">

                    <span>
                        Tax (5%)
                    </span>

                    <span>
                        Rs. {{ number_format($tax,2) }}
                    </span>

                </div>


                <div class="flex justify-between mb-4">

                    <span>
                        Delivery
                    </span>

                    <span>
                        Rs. {{ number_format($delivery,2) }}
                    </span>

                </div>


                <hr class="my-5">


                <div class="flex justify-between text-2xl font-bold mb-6">

                    <span>
                        Total
                    </span>


                    <span class="text-orange-600">

                        Rs. {{ number_format($total,2) }}

                    </span>


                </div>


                <!-- Coupon Form -->

                <form action="{{ route('coupon.apply') }}" method="POST">

                    @csrf

                    <input
                        type="text"
                        name="coupon"
                        placeholder="Coupon Code"
                        class="border rounded-lg w-full px-4 py-3 mb-4">


                    <button
                        type="submit"
                        class="w-full bg-gray-800 hover:bg-black text-white py-3 rounded-lg">

                        Apply Coupon

                    </button>

                </form>
                
                <a href="{{ route('checkout') }}"
                   class="block w-full bg-orange-600 hover:bg-orange-700 text-white text-center py-4 rounded-lg font-semibold mt-4">

                    Proceed to Checkout

                </a>


                <a href="{{ route('menu') }}"
                   class="block w-full mt-4 border border-gray-300 text-center py-3 rounded-lg hover:bg-gray-100">

                    Continue Shopping

                </a>


            </div>

        </div>


    </div>

</div>


@endsection