@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Order Details
    </h1>

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-bold mb-4">
            {{ $order->order_number }}
        </h2>

        <div class="grid grid-cols-2 gap-4 mb-6">

            <div>
                <strong>Customer:</strong>
                {{ $order->customer?->name }}
            </div>

            <div>
                <strong>Phone:</strong>
                {{ $order->customer?->phone }}
            </div>

            <div>
                <strong>Email:</strong>
                {{ $order->customer?->email }}
            </div>

            <div>
                <strong>Table:</strong>
                {{ $order->table?->table_name }}
            </div>

            <div>
                <strong>Status:</strong>
                {{ $order->status }}
            </div>

            <div>
                <strong>Payment:</strong>
                {{ $order->payment_status }}
            </div>

            <div class="col-span-2">
                <strong>Notes:</strong>
                {{ $order->notes }}
            </div>

        </div>

        <hr class="my-5">

        <h3 class="text-xl font-bold mb-4">
            Ordered Items
        </h3>

        <table class="w-full border">

            <thead class="bg-gray-100">

            <tr>
                <th class="border p-2">Item</th>
                <th class="border p-2">Qty</th>
                <th class="border p-2">Price</th>
                <th class="border p-2">Subtotal</th>
            </tr>

            </thead>

            <tbody>

            @foreach($order->orderItems as $item)

            <tr>

                <td class="border p-2">
                    {{ $item->menuItem->name }}
                </td>

                <td class="border p-2">
                    {{ $item->quantity }}
                </td>

                <td class="border p-2">
                    Rs. {{ number_format($item->unit_price,2) }}
                </td>

                <td class="border p-2">
                    Rs. {{ number_format($item->subtotal,2) }}
                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

        <div class="text-right mt-6 text-2xl font-bold">

            Total:
            Rs. {{ number_format($order->total_amount,2) }}

        </div>

    </div>

</div>
@if($order->payment_status === 'Unpaid')
    <form action="{{ route('orders.pay', $order) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            💰 Mark as Paid
        </button>
    </form>
@else
    <span class="bg-green-100 text-green-700 px-4 py-2 rounded">
        ✅ Paid
    </span>
    
@endif
@if($order->payment_status === 'Unpaid')

    <form action="{{ route('orders.mark-paid', $order) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')

        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg font-semibold">
            💰 Mark as Paid
        </button>
    </form>

@else

    <span class="inline-block mt-4 bg-green-100 text-green-700 px-5 py-2 rounded-lg font-semibold">
        ✅ Paid
    </span>

@endif

@endsection