@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold">
            Kitchen Inventory
        </h1>

        <p class="text-gray-500 mt-1">
            Monitor ingredient stock and inventory levels.
        </p>
    </div>

    <a href="{{ route('ingredients.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">
        Manage Ingredients
    </a>

</div>


{{-- Success Message --}}

@if(session('success'))

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
        {{ session('success') }}
    </div>

@endif


{{-- ================= SUMMARY CARDS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

    {{-- Total Ingredients --}}

    <div class="bg-white rounded-lg shadow p-5">

        <p class="text-gray-500 text-sm">
            Total Ingredients
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $totalIngredients }}
        </h2>

    </div>


    {{-- Low Stock --}}

    <div class="bg-yellow-50 border border-yellow-200 rounded-lg shadow p-5">

        <p class="text-yellow-700 text-sm">
            Low Stock
        </p>

        <h2 class="text-3xl font-bold text-yellow-700 mt-2">
            {{ $lowStockIngredients }}
        </h2>

    </div>


    {{-- Out of Stock --}}

    <div class="bg-red-50 border border-red-200 rounded-lg shadow p-5">

        <p class="text-red-700 text-sm">
            Out of Stock
        </p>

        <h2 class="text-3xl font-bold text-red-700 mt-2">
            {{ $outOfStockIngredients }}
        </h2>

    </div>


    {{-- Inventory Value --}}

    <div class="bg-blue-50 border border-blue-200 rounded-lg shadow p-5">

        <p class="text-blue-700 text-sm">
            Inventory Value
        </p>

        <h2 class="text-2xl font-bold text-blue-700 mt-2">
            Rs. {{ number_format($totalInventoryValue, 2) }}
        </h2>

    </div>

</div>


{{-- ================= SEARCH / FILTER ================= --}}

<div class="bg-white rounded-lg shadow p-5 mb-6">

    <form method="GET"
          action="{{ route('kitchen-inventory.index') }}"
          class="flex flex-wrap gap-3">

        {{-- Search --}}

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search ingredient..."
            class="border rounded px-4 py-2 w-72">


        {{-- Stock Filter --}}

        <select
            name="stock_status"
            class="border rounded px-4 py-2">

            <option value="">
                All Stock
            </option>

            <option value="low"
                {{ request('stock_status') === 'low' ? 'selected' : '' }}>
                Low Stock
            </option>

            <option value="available"
                {{ request('stock_status') === 'available' ? 'selected' : '' }}>
                Available Stock
            </option>

        </select>


        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

            Search

        </button>


        <a
            href="{{ route('kitchen-inventory.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

            Reset

        </a>

    </form>

</div>


{{-- ================= INVENTORY TABLE ================= --}}

<div class="bg-white rounded-lg shadow overflow-x-auto">

    <table class="min-w-full table-auto">

        <thead class="bg-gray-200">

            <tr>

                <th class="p-3 text-left">
                    Ingredient
                </th>

                <th class="p-3 text-left">
                    Unit
                </th>

                <th class="p-3 text-center">
                    Current Stock
                </th>

                <th class="p-3 text-center">
                    Minimum Stock
                </th>

                <th class="p-3 text-center">
                    Cost / Unit
                </th>

                <th class="p-3 text-center">
                    Stock Value
                </th>

                <th class="p-3 text-center">
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

        @forelse($ingredients as $ingredient)

            @php

                $stock = (float) $ingredient->stock_quantity;

                $minimum = (float) $ingredient->minimum_stock;

                $stockValue =
                    $stock * (float) $ingredient->cost_per_unit;

            @endphp


            <tr class="border-t hover:bg-gray-50">

                {{-- Ingredient --}}

                <td class="p-3 font-semibold">

                    {{ $ingredient->name }}

                </td>


                {{-- Unit --}}

                <td class="p-3">

                    {{ $ingredient->unit }}

                </td>


                {{-- Current Stock --}}

                <td class="p-3 text-center">

                    <span class="font-bold">

                        {{ number_format($stock, 3) }}

                    </span>

                </td>


                {{-- Minimum Stock --}}

                <td class="p-3 text-center">

                    {{ number_format($minimum, 3) }}

                </td>


                {{-- Cost --}}

                <td class="p-3 text-center">

                    Rs.
                    {{ number_format($ingredient->cost_per_unit, 2) }}

                </td>


                {{-- Stock Value --}}

                <td class="p-3 text-center font-semibold">

                    Rs.
                    {{ number_format($stockValue, 2) }}

                </td>


                {{-- Status --}}

                <td class="p-3 text-center">

                    @if($stock <= 0)

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">

                            Out of Stock

                        </span>

                    @elseif($stock <= $minimum)

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">

                            Low Stock

                        </span>

                    @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                            In Stock

                        </span>

                    @endif

                </td>

            </tr>


        @empty

            <tr>

                <td
                    colspan="7"
                    class="text-center p-8 text-gray-500">

                    No ingredients found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>


{{-- ================= PAGINATION ================= --}}

<div class="mt-6">

    {{ $ingredients->links() }}

</div>


@endsection