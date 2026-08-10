@extends('frontend.layouts.app')

@section('title','Track Order')

@section('content')

<div class="space-y-8">

    <h1 class="text-4xl font-bold text-center">
        🍽 Order Tracking
    </h1>

    {{-- Current Status Card --}}
    <div class="bg-linear-to-r from-red-600 to-orange-500 text-white rounded-3xl p-8 shadow-lg">

        <h1 class="text-4xl font-bold">
            {{ $order->order_number }}
        </h1>

        <p class="mt-3 text-lg">
            Current Status
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $order->status }}
        </h2>

    </div>

    {{-- Timeline --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-8 text-center">
            Order Progress
        </h2>

        <div class="flex justify-between items-center">

            {{-- Step 1 --}}
            <div class="flex flex-col items-center flex-1">

                <div class="w-16 h-16 rounded-full flex items-center justify-center
                    {{ in_array($order->status,['Pending','Preparing','Ready','Completed']) ? 'bg-green-500 text-white' : 'bg-gray-300' }}">

                    ✅

                </div>

                <p class="mt-3 font-semibold">
                    Order Placed
                </p>

            </div>

            <div class="flex-1 h-1
                {{ in_array($order->status,['Preparing','Ready','Completed']) ? 'bg-green-500' : 'bg-gray-300' }}">
            </div>

            {{-- Step 2 --}}
            <div class="flex flex-col items-center flex-1">

                <div class="w-16 h-16 rounded-full flex items-center justify-center
                    {{ in_array($order->status,['Preparing','Ready','Completed']) ? 'bg-yellow-500 text-white' : 'bg-gray-300' }}">

                    👨‍🍳

                </div>

                <p class="mt-3 font-semibold">
                    Preparing
                </p>

            </div>

            <div class="flex-1 h-1
                {{ in_array($order->status,['Ready','Completed']) ? 'bg-green-500' : 'bg-gray-300' }}">
            </div>
                        {{-- Step 3 --}}
            <div class="flex flex-col items-center flex-1">

                <div class="w-16 h-16 rounded-full flex items-center justify-center
                    {{ in_array($order->status,['Ready','Completed']) ? 'bg-blue-500 text-white' : 'bg-gray-300' }}">

                    🍽

                </div>

                <p class="mt-3 font-semibold">
                    Ready
                </p>

            </div>

            <div class="flex-1 h-1
                {{ $order->status == 'Completed' ? 'bg-green-500' : 'bg-gray-300' }}">
            </div>

            {{-- Step 4 --}}
            <div class="flex flex-col items-center flex-1">

                <div class="w-16 h-16 rounded-full flex items-center justify-center
                    {{ $order->status == 'Completed' ? 'bg-green-600 text-white' : 'bg-gray-300' }}">

                    🚚

                </div>

                <p class="mt-3 font-semibold">
                    Delivered
                </p>

            </div>

        </div>

    </div>

    {{-- Order Summary --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6">
            Order Details
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <strong>Customer</strong><br>
                {{ $order->customer->name }}
            </div>

            <div>
                <strong>Table</strong><br>
                {{ $order->restaurantTable->table_number ?? 'N/A' }}
            </div>

            <div>
                <strong>Payment</strong><br>
                {{ $order->payment_status }}
            </div>

            <div>
                <strong>Total</strong><br>
                Rs. {{ number_format($order->total_amount, 2) }}
            </div>

        </div>

    </div>

    {{-- Ordered Items --}}
    <div class="bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-5">
            Ordered Items
        </h2>

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-3">Item</th>
                    <th class="text-left">Qty</th>
                    <th class="text-left">Subtotal</th>

                </tr>

            </thead>

            <tbody>
                                @foreach($order->orderItems as $item)

                    <tr class="border-b">

                        <td class="py-3">
                            {{ $item->menuItem->name }}
                        </td>

                        <td>
                            {{ $item->quantity }}
                        </td>

                        <td>
                            Rs. {{ number_format($item->subtotal, 2) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    @if($order->status != 'Completed')

        <script>
            setInterval(function () {
                location.reload();
            }, 5000);
        </script>

    @endif

</div>
@endsection
