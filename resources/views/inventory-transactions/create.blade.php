@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Inventory Transaction
</h1>

@if($errors->any())

<div class="bg-red-100 text-red-700 p-4 rounded mb-4">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('inventory-transactions.store') }}" method="POST">

    @csrf

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">
                Ingredient
            </label>

            <select
                name="ingredient_id"
                class="w-full border rounded p-2">

                @foreach($ingredients as $ingredient)

                    <option value="{{ $ingredient->id }}">
                        {{ $ingredient->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Transaction Type
            </label>

            <select
                name="transaction_type"
                class="w-full border rounded p-2">

                <option value="Stock In">
                    Stock In
                </option>

                <option value="Stock Out">
                    Stock Out
                </option>

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Quantity
            </label>

            <input
                type="number"
                step="0.01"
                min="0.01"
                name="quantity"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Reference
            </label>

            <input
                type="text"
                name="reference"
                class="w-full border rounded p-2">

        </div>

    </div>

    <div class="mt-6">

        <label class="block mb-2 font-semibold">
            Notes
        </label>

        <textarea
            name="notes"
            rows="4"
            class="w-full border rounded p-2"></textarea>

    </div>

    <div class="mt-6">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

            Save Transaction

        </button>

        <a
            href="{{ route('inventory-transactions.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

            Cancel

        </a>

    </div>

</form>

</div>

@endsection