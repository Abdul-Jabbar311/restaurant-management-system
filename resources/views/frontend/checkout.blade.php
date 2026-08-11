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

                <form id="checkoutForm"
                      action="{{ route('place.order') }}"
                      method="POST">

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


                    <!-- Payment Method -->
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


                    <!-- Place Order -->
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


                <!-- Coupon -->
                <form
                    action="{{ route('coupon.apply') }}"
                    method="POST"
                    class="mb-5">

                    @csrf

                    <div class="flex gap-2">

                        <input
                            type="text"
                            name="code"
                            placeholder="Coupon Code"
                            class="border rounded px-3 py-2 flex-1">

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 rounded">

                            Apply

                        </button>

                    </div>

                </form>


                <!-- Subtotal -->
                <div class="flex justify-between mb-4">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        Rs. {{ number_format($grandTotal, 2) }}
                    </span>

                </div>


                <!-- Tax -->
                <div class="flex justify-between mb-4">

                    <span>
                        Tax
                    </span>

                    <span>
                        Rs. {{ number_format($tax, 2) }}
                    </span>

                </div>


                <!-- Delivery -->
                <div class="flex justify-between mb-4">

                    <span>
                        Delivery
                    </span>

                    <span>
                        Rs. {{ number_format($delivery, 2) }}
                    </span>

                </div>


                <hr class="my-5">


                <!-- Total -->
                <div class="flex justify-between text-2xl font-bold">

                    <span>
                        Total
                    </span>

                    <span class="text-orange-600">

                        Rs. {{ number_format($total, 2) }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ========================================= -->
<!-- ORDER SUCCESS ANIMATION -->
<!-- ========================================= -->

<div id="orderSuccessOverlay">

    <div class="success-card">

        <!-- Animated Check -->
        <div class="success-icon">
            ✓
        </div>


        <h1>
            Order Placed Successfully!
        </h1>


        <p class="success-main">
            Thank you for your order! 🎉
        </p>


        <p class="success-sub">
            Your order has been received and is now being processed.
            Please wait while our team prepares your delicious meal.
        </p>


        <div class="order-status">

            <span class="status-dot"></span>

            Order Processing

        </div>


        <!-- Loading Animation -->
        <div class="success-loader">

            <span></span>
            <span></span>
            <span></span>

        </div>

    </div>

</div>



<style>

/* Full screen overlay */
#orderSuccessOverlay {

    position: fixed;

    inset: 0;

    background: rgba(15, 23, 42, 0.75);

    backdrop-filter: blur(8px);

    display: none;

    align-items: center;

    justify-content: center;

    z-index: 99999;

}


/* Show overlay */
#orderSuccessOverlay.show {

    display: flex;

}


/* Success card */
.success-card {

    width: min(500px, 90%);

    background: white;

    border-radius: 24px;

    padding: 45px 35px;

    text-align: center;

    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);

    animation: successCard 0.6s ease;

}


/* Check icon */
.success-icon {

    width: 90px;

    height: 90px;

    margin: 0 auto 25px;

    border-radius: 50%;

    background: #16a34a;

    color: white;

    font-size: 55px;

    display: flex;

    align-items: center;

    justify-content: center;

    animation: pop 0.6s cubic-bezier(.17,.67,.35,1.4);

    box-shadow: 0 10px 30px rgba(22, 163, 74, 0.3);

}


/* Heading */
.success-card h1 {

    font-size: 30px;

    font-weight: 700;

    margin-bottom: 12px;

    color: #111827;

}


/* Main message */
.success-main {

    font-size: 18px;

    color: #374151;

    margin-bottom: 8px;

}


/* Description */
.success-sub {

    color: #6b7280;

    line-height: 1.6;

    margin-bottom: 25px;

}


/* Processing status */
.order-status {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    background: #fff7ed;

    color: #ea580c;

    padding: 10px 18px;

    border-radius: 30px;

    font-weight: 600;

}


/* Orange status dot */
.status-dot {

    width: 9px;

    height: 9px;

    background: #f97316;

    border-radius: 50%;

    animation: pulse 1.2s infinite;

}


/* Loading dots */
.success-loader {

    margin-top: 25px;

}


.success-loader span {

    display: inline-block;

    width: 8px;

    height: 8px;

    margin: 0 4px;

    background: #f97316;

    border-radius: 50%;

    animation: loading 1.2s infinite;

}


.success-loader span:nth-child(2) {

    animation-delay: 0.2s;

}


.success-loader span:nth-child(3) {

    animation-delay: 0.4s;

}



/* Card animation */
@keyframes successCard {

    from {

        transform: translateY(30px) scale(0.9);

        opacity: 0;

    }

    to {

        transform: translateY(0) scale(1);

        opacity: 1;

    }

}


/* Check animation */
@keyframes pop {

    0% {

        transform: scale(0);

    }

    70% {

        transform: scale(1.15);

    }

    100% {

        transform: scale(1);

    }

}


/* Status pulse */
@keyframes pulse {

    0%, 100% {

        transform: scale(1);

        opacity: 1;

    }

    50% {

        transform: scale(1.5);

        opacity: 0.5;

    }

}


/* Loading dots */
@keyframes loading {

    0%, 60%, 100% {

        transform: translateY(0);

        opacity: 0.4;

    }

    30% {

        transform: translateY(-8px);

        opacity: 1;

    }

}

</style>



<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('checkoutForm');
    const overlay = document.getElementById('orderSuccessOverlay');

    if (!form || !overlay) {
        return;
    }

    form.addEventListener('submit', function (event) {

        // Stop immediate submission
        event.preventDefault();

        const button = form.querySelector(
            'button[type="submit"]'
        );

        if (button) {
            button.disabled = true;
            button.innerHTML = 'Processing Order...';
        }

        // Show success animation
        overlay.classList.add('show');

        // Keep it visible for 5 seconds
        setTimeout(function () {

            // Submit the form normally
            form.submit();

        }, 5000);

    });

});
</script>

@endsection