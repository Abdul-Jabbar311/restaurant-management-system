@extends('frontend.layouts.app')

@section('title','My Orders')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold mb-8">
        My Orders
    </h1>

    @if(session('error'))

        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>

    @endif

    <div class="bg-white shadow rounded-xl p-6 mb-8">

        <form action="{{ route('my.orders.search') }}" method="POST">

            @csrf

            <label class="font-semibold block mb-2">
                Enter Phone Number
            </label>

            <div class="flex gap-3">

                <input
                    type="text"
                    name="phone"
                    class="border rounded-lg px-4 py-3 flex-1"
                    placeholder="03XXXXXXXXX"
                    required>

                <button
                    class="bg-orange-600 hover:bg-orange-700 text-white px-8 rounded-lg">

                    Search

                </button>

            </div>

        </form>

    </div>

    @isset($customer)

        <div class="mb-6">

            <h2 class="text-2xl font-bold">

                {{ $customer->name }}

            </h2>

            <p class="text-gray-600">

                {{ $customer->phone }}

            </p>

        </div>

    @endisset

    @isset($orders)

        @forelse($orders as $order)

            <div class="bg-white shadow rounded-xl p-6 mb-5">

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="text-xl font-bold">

                            {{ $order->order_number }}

                        </h3>

                        <p class="text-gray-500">

                            {{ $order->created_at->format('d M Y h:i A') }}

                        </p>

                    </div>

                    <div class="text-right">

                        <span class="font-bold text-orange-600">

                            Rs. {{ number_format($order->total_amount,2) }}

                        </span>

                        <br>

                        <span class="inline-block mt-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                            {{ $order->status }}

                        </span>

                    </div>

                </div>

                <div class="mt-5">

                    <a
                        href="{{ route('track.order',$order) }}"
                        class="bg-orange-600 hover:bg-orange-700 text-white px-5 py-2 rounded">

                        View Details

                    </a>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-xl shadow p-8 text-center">

                No Orders Found.

            </div>

        @endforelse

    @endisset

</div>

@endsection