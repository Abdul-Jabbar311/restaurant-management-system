@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Inventory Transactions
    </h1>

    <a href="{{ route('inventory-transactions.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Transaction
    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
    {{ session('success') }}
</div>

@endif

<form method="GET" class="mb-5 flex gap-2">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search Ingredient / Type..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('inventory-transactions.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full table-auto">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Ingredient</th>
<th class="p-3 text-center">Type</th>
<th class="p-3 text-center">Quantity</th>
<th class="p-3 text-left">Reference</th>
<th class="p-3 text-left">Notes</th>
<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($transactions as $transaction)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">
    {{ $transaction->ingredient->name }}
</td>

<td class="p-3 text-center">

    @if($transaction->transaction_type == 'Stock In')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            Stock In
        </span>

    @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
            Stock Out
        </span>

    @endif

</td>

<td class="p-3 text-center">
    {{ $transaction->quantity }}
</td>

<td class="p-3">
    {{ $transaction->reference ?? '-' }}
</td>

<td class="p-3">
    {{ $transaction->notes ?? '-' }}
</td>

<td class="p-3">

<div class="flex justify-center items-center gap-2 whitespace-nowrap">

    <a href="{{ route('inventory-transactions.show',$transaction) }}"
       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
        View
    </a>

    <a href="{{ route('inventory-transactions.edit',$transaction) }}"
       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
        Edit
    </a>

    <form
        action="{{ route('inventory-transactions.destroy',$transaction) }}"
        method="POST"
        class="inline-flex">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            onclick="return confirm('Delete Transaction?')"
            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
            Delete
        </button>

    </form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center p-6 text-gray-500">
    No Transactions Found.
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $transactions->links() }}

</div>

@endsection