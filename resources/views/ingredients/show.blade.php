@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Ingredient Details
    </h1>

    <a href="{{ route('ingredients.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">
        Back
    </a>

</div>

<div class="bg-white rounded-lg shadow p-6">

    <div class="grid grid-cols-2 gap-6">

        <div>
            <p class="text-gray-500 text-sm">Ingredient</p>
            <p class="text-lg font-semibold">
                {{ $ingredient->name }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Supplier</p>
            <p class="text-lg">
                {{ $ingredient->supplier?->name ?? 'N/A' }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Unit</p>
            <p class="text-lg">
                {{ $ingredient->unit }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Current Stock</p>
            <p class="text-lg font-semibold">
                {{ number_format($ingredient->stock_quantity, 3) }}
                {{ $ingredient->unit }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Minimum Stock</p>
            <p class="text-lg">
                {{ number_format($ingredient->minimum_stock, 3) }}
                {{ $ingredient->unit }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Cost Per Unit</p>
            <p class="text-lg">
                Rs. {{ number_format($ingredient->cost_per_unit, 2) }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Status</p>

            @if($ingredient->is_active)

                <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    Active
                </span>

            @else

                <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full">
                    Inactive
                </span>

            @endif

        </div>

    </div>

</div>

@endsection