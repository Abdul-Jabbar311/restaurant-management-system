@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Orders
    </h1>

    <div class="flex gap-3">

        <a href="{{ route('export.orders') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">
            Export PDF
        </a>

        <a href="{{ route('orders.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
            + New Order
        </a>

    </div>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>

@endif

<form action="{{ route('orders.index') }}"
      method="GET"
      class="flex gap-3 mb-6">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search Order Number or Customer..."
        class="border rounded px-4 py-2 w-80">

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('orders.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

    <table class="min-w-full table-auto">

        <thead class="bg-gray-200">

        <tr>

            <th class="p-3 text-left">
                Order No
            </th>

            <th class="p-3 text-left">
                Customer
            </th>

            <th class="p-3 text-left">
                Table
            </th>

            <th class="p-3 text-center">
                Status
            </th>

            <th class="p-3 text-left">
                Total
            </th>

            <th class="p-3">
                Date
            </th>

            <th>
                Payment
            </th>

            <th class="p-3 text-center w-64">
                Actions
            </th>

        </tr>

        </thead>

        <tbody>

        @forelse($orders as $order)

        <tr class="border-t hover:bg-gray-50">

            <td class="p-3 font-medium">
                {{ $order->order_number }}
            </td>

            <td class="p-3">
                {{ $order->customer?->name ?? 'Walk-in Customer' }}
            </td>

            <td class="p-3">
                {{ $order->restaurantTable?->table_number ?? '-' }}
            </td>

            <td class="p-3 text-center">

                @if($order->status == 'Pending')

                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                    🟡 Pending
                </span>

                @elseif($order->status == 'Preparing')

                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                    👨‍🍳 Preparing
                </span>

                @elseif($order->status == 'Ready')

                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    ✅ Ready
                </span>

                @else

                <span class="px-3 py-1 bg-gray-800 text-white rounded-full text-sm font-semibold">
                    ✔ Completed
                </span>

                @endif

            </td>

            <td class="p-3">
                Rs. {{ number_format($order->total_amount, 2) }}
            </td>

            <td class="p-3">
                {{ $order->created_at->format('d M Y') }}
            </td>

            <td>

                @if($order->payment_status=='Paid')

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    Paid
                </span>

                @else

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                    Unpaid
                </span>

                @endif

            </td>

            <td class="p-3">

                <div class="flex justify-center items-center gap-2 whitespace-nowrap">

                    <a href="{{ route('orders.show', $order) }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                        View
                    </a>

                   @if($order->status != 'Completed')

<form action="{{ route('orders.updateStatus',$order) }}"
      method="POST">

    @csrf
    @method('PATCH')

    <button
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">

        @if($order->status=='Pending')

            Accept

        @elseif($order->status=='Preparing')

            Mark Ready

        @elseif($order->status=='Ready')

            Complete

        @endif

    </button>

</form>

@endif

                    <form action="{{ route('orders.destroy', $order) }}"
                          method="POST"
                          class="inline-flex">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Delete Order?')"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">

                            Delete

                        </button>

                    </form>

                </div>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="8" class="text-center p-6 text-gray-500">

                No Orders Found.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $orders->withQueryString()->links() }}

</div>

@endsection