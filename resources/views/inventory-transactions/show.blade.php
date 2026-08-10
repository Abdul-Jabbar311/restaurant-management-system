
@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h2 class="text-2xl font-bold">
        Inventory Transaction Details
    </h2>

    <a href="{{ route('inventory-transactions.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Back
    </a>

</div>

<div class="bg-white rounded-lg shadow p-6">

    <div class="space-y-4">

        <div>
            <strong>Ingredient:</strong>

            {{ $inventoryTransaction->ingredient->name ?? 'N/A' }}
        </div>

        <div>
            <strong>Transaction Type:</strong>

            @if($inventoryTransaction->transaction_type == 'Stock In')

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded font-semibold">
                    Stock In
                </span>

            @else

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded font-semibold">
                    Stock Out
                </span>

            @endif

        </div>

        <div>
            <strong>Quantity:</strong>

            <span class="font-semibold">
                {{ $inventoryTransaction->quantity }}
            </span>
        </div>

        <div>
            <strong>Reference:</strong>

            {{ $inventoryTransaction->reference ?? 'N/A' }}
        </div>

        <div>
            <strong>Notes:</strong>

            @if($inventoryTransaction->notes)

                <p class="mt-2 bg-gray-100 p-4 rounded">
                    {{ $inventoryTransaction->notes }}
                </p>

            @else

                <p class="mt-2 bg-gray-100 p-4 rounded">
                    N/A
                </p>

            @endif

        </div>

        <div>
            <strong>Created:</strong>

            {{ $inventoryTransaction->created_at->format('d M Y, h:i A') }}
        </div>

        <div>
            <strong>Last Updated:</strong>

            {{ $inventoryTransaction->updated_at->format('d M Y, h:i A') }}
        </div>

    </div>

</div>

@endsection

