@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Kitchen Orders
    </h1>

    <a href="{{ route('kitchen-orders.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Kitchen Order
    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif

<form method="GET" class="mb-5 flex gap-2">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search Order ID..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('kitchen-orders.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="min-w-full">

        <thead class="bg-gray-200">

            <tr>

                <th class="p-3 text-left">Order ID</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-center">Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($kitchenOrders as $kitchenOrder)

            <tr class="border-t hover:bg-gray-50">

                <td class="p-3 font-medium">
                    #{{ $kitchenOrder->id }}
                </td>

                <td class="p-3">
                    {{ $kitchenOrder->status }}
                </td>

                <td class="p-3">

                    <form action="{{ route('kitchen-orders.updateStatus', $kitchenOrder) }}" method="POST">

                        @csrf
                        @method('PATCH')

                        @if($kitchenOrder->status == 'Pending')

                            <input type="hidden" name="status" value="Preparing">

                            <button
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                Start Preparing

                            </button>

                        @elseif($kitchenOrder->status == 'Preparing')

                            <input type="hidden" name="status" value="Ready">

                            <button
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                                Mark Ready

                            </button>

                        @else

                            <input type="hidden" name="status" value="Pending">

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                Reset

                            </button>

                        @endif

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="3" class="text-center p-6 text-gray-500">

                    No Kitchen Orders Found.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $kitchenOrders->links() }}

</div>

@endsection