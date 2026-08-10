@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Ingredients
    </h1>

    <a href="{{ route('ingredients.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Ingredient
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
        placeholder="Search Ingredient / Supplier..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('ingredients.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full table-auto">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Ingredient</th>
<th class="p-3 text-left">Supplier</th>
<th class="p-3 text-left">Unit</th>
<th class="p-3 text-center">Stock</th>
<th class="p-3 text-center">Minimum</th>
<th class="p-3 text-center">Cost</th>
<th class="p-3 text-center">Status</th>
<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($ingredients as $ingredient)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">
    {{ $ingredient->name }}
</td>

<td class="p-3">
    {{ $ingredient->supplier->name }}
</td>

<td class="p-3">
    {{ $ingredient->unit }}
</td>

<td class="p-3 text-center">
    {{ $ingredient->stock_quantity }}
</td>

<td class="p-3 text-center">
    {{ $ingredient->minimum_stock }}
</td>

<td class="p-3 text-center">
    Rs. {{ number_format($ingredient->cost_per_unit,2) }}
</td>

<td class="p-3 text-center">

    @if($ingredient->is_active)

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            Active
        </span>

    @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
            Inactive
        </span>

    @endif

</td>

<td class="p-3">

<div class="flex justify-center items-center gap-2 whitespace-nowrap">

    <a href="{{ route('ingredients.show',$ingredient) }}"
       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
        View
    </a>

    <a href="{{ route('ingredients.edit',$ingredient) }}"
       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
        Edit
    </a>

    <form
        action="{{ route('ingredients.destroy',$ingredient) }}"
        method="POST"
        class="inline-flex">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            onclick="return confirm('Delete Ingredient?')"
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
    No Ingredients Found.
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $ingredients->links() }}

</div>

@endsection