@extends('layouts.app')

@section('content')

{{-- ========================================================= --}}
{{-- NOTIFICATIONS --}}
{{-- ========================================================= --}}

@if(isset($notifications) && $notifications->count())

    <div class="bg-white rounded-3xl shadow-xl p-6 mb-8">

        <div class="flex items-center justify-between mb-5">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    🔔 Notifications
                </h2>

                <p class="text-gray-500 mt-1">
                    Important updates about restaurant orders.
                </p>
            </div>

            <span class="bg-red-600 text-white px-4 py-2 rounded-full font-bold">
                {{ $notifications->where('is_read', false)->count() }} New
            </span>

        </div>


        @foreach($notifications as $notification)

            <div class="border-l-4 border-orange-500 bg-orange-50 rounded-2xl p-5 mb-3">

                <div class="flex justify-between items-start gap-4">

                    <div>

                        <h3 class="font-bold text-lg text-gray-800">
                            {{ $notification->title }}
                        </h3>

                        <p class="text-gray-600 mt-1">
                            {{ $notification->message }}
                        </p>

                    </div>

                    @if(!$notification->is_read)

                        <span class="bg-red-600 text-white text-xs px-3 py-1 rounded-full">
                            NEW
                        </span>

                    @endif

                </div>

                <div class="mt-3 text-sm text-gray-400">

                    {{ $notification->created_at->diffForHumans() }}

                </div>

            </div>

        @endforeach

    </div>

@endif


{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<div class="rounded-3xl overflow-hidden shadow-2xl bg-linear-to-r from-red-600 via-orange-500 to-yellow-500 mb-8">

    <div class="p-10 flex justify-between items-center">

        <div>

            <h1 class="text-5xl font-bold text-white mb-2">
                🍽 Waiter Dashboard
            </h1>

            <p class="text-red-100 text-lg">
                Deliver food quickly and keep customers happy.
            </p>

        </div>

        <div class="text-right">

            <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center text-4xl mx-auto">
                👨‍🍳
            </div>

            <h3 class="text-white font-bold mt-3">
                {{ auth()->user()->name }}
            </h3>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- STATISTICS --}}
{{-- ========================================================= --}}

<div class="grid md:grid-cols-4 gap-6 mb-10">


    {{-- Ready Orders --}}

    <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 transition">

        <div class="text-5xl mb-4">
            🍽
        </div>

        <h4 class="text-gray-500">
            Ready Orders
        </h4>

        <h1 class="text-4xl font-bold text-green-600 mt-2">
            {{ $orders->count() }}
        </h1>

    </div>


    {{-- Delivered Today --}}

    <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 transition">

        <div class="text-5xl mb-4">
            🚚
        </div>

        <h4 class="text-gray-500">
            Delivered Today
        </h4>

        <h1 class="text-4xl font-bold text-blue-600 mt-2">
            {{ $deliveredToday }}
        </h1>

    </div>


    {{-- Average Delivery --}}

    <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 transition">

        <div class="text-5xl mb-4">
            ⏱
        </div>

        <h4 class="text-gray-500">
            Avg Delivery
        </h4>

        <h1 class="text-4xl font-bold text-orange-600">
            12 min
        </h1>

    </div>


    {{-- Performance --}}

    <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 transition">

        <div class="text-5xl mb-4">
            ⭐
        </div>

        <h4 class="text-gray-500">
            Performance
        </h4>

        <h1 class="text-4xl font-bold text-yellow-500">
            100%
        </h1>

    </div>

</div>


{{-- ========================================================= --}}
{{-- READY ORDERS --}}
{{-- ========================================================= --}}

@forelse($orders as $order)


    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8 hover:shadow-red-300 transition">


        {{-- ORDER HEADER --}}

        <div class="bg-linear-to-r from-green-600 to-green-500 p-6 flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-white">
                    🍽 {{ $order->order_number }}
                </h2>

                <p class="text-green-100">
                    Ready for Delivery
                </p>

            </div>

            <span class="bg-white text-green-700 px-5 py-2 rounded-full font-bold">

                ✅ READY

            </span>

        </div>


        {{-- ORDER CONTENT --}}

        <div class="p-8">


            {{-- ORDER INFORMATION --}}

            <div class="grid md:grid-cols-3 gap-8">


                {{-- TABLE --}}

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="text-4xl mb-2">
                        🍴
                    </div>

                    <h5 class="text-gray-500">
                        Table
                    </h5>

                    <h2 class="text-3xl font-bold">

                        {{ $order->restaurantTable->table_number ?? 'N/A' }}

                    </h2>

                </div>


                {{-- CUSTOMER --}}

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="text-4xl mb-2">
                        👤
                    </div>

                    <h5 class="text-gray-500">
                        Customer
                    </h5>

                    <h2 class="text-2xl font-bold">

                        {{ $order->customer->name ?? 'N/A' }}

                    </h2>

                </div>


                {{-- TOTAL --}}

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="text-4xl mb-2">
                        💰
                    </div>

                    <h5 class="text-gray-500">
                        Total Bill
                    </h5>

                    <h2 class="text-3xl font-bold text-red-600">

                        Rs {{ number_format($order->total_amount, 2) }}

                    </h2>

                </div>

            </div>


            <hr class="my-8">


            {{-- ORDERED ITEMS --}}

            <h3 class="text-2xl font-bold mb-6">
                🍔 Ordered Items
            </h3>


            <div class="space-y-4">

                @foreach($order->orderItems as $item)

                    <div class="flex justify-between items-center bg-gray-100 rounded-xl p-4">

                        <div>

                            <h4 class="font-bold text-lg">

                                {{ $item->menuItem->name }}

                            </h4>

                        </div>

                        <span class="bg-red-600 text-white px-4 py-2 rounded-full">

                            x{{ $item->quantity }}

                        </span>

                    </div>

                @endforeach

            </div>


            {{-- DELIVER ORDER --}}

            <form
                action="{{ route('orders.deliver', $order) }}"
                method="POST"
                class="mt-8"
            >

                @csrf

                @method('PATCH')

                <button
                    type="submit"
                    class="w-full py-4 rounded-2xl bg-linear-to-r from-green-600 to-green-700 hover:scale-105 transition text-white text-xl font-bold shadow-xl"
                >

                    🚚 Deliver Order

                </button>

            </form>


        </div>

    </div>


@empty


    {{-- NO READY ORDERS --}}

    <div class="bg-white rounded-3xl shadow-2xl text-center py-20">

        <div class="text-8xl mb-6">
            🍽
        </div>

        <h2 class="text-4xl font-bold mb-4">
            Great Job!
        </h2>

        <p class="text-gray-500 text-xl">
            There are no ready orders waiting for delivery.
        </p>

        <p class="text-gray-400 mt-2">
            Enjoy a short break ☕
        </p>

    </div>


@endforelse

@endsection