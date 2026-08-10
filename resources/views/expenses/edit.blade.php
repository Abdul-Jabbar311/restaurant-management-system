@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <h2 class="text-2xl font-bold mb-6">
        Edit Expense
    </h2>

    <form action="{{ route('expenses.update', $expense->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">
                Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $expense->title) }}"
                class="w-full border rounded px-3 py-2"
                required>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">
                Category
            </label>

            <select
                name="category"
                class="w-full border rounded px-3 py-2"
                required>

                @foreach([
                    'Electricity',
                    'Gas',
                    'Salary',
                    'Maintenance',
                    'Rent',
                    'Other'
                ] as $category)

                    <option
                        value="{{ $category }}"
                        {{ old('category', $expense->category) == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>

                @endforeach

            </select>
        </div>

        <!-- Amount -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">
                Amount
            </label>

            <input
                type="number"
                name="amount"
                step="0.01"
                min="0"
                value="{{ old('amount', $expense->amount) }}"
                class="w-full border rounded px-3 py-2"
                required>
        </div>

        <!-- Expense Date -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">
                Expense Date
            </label>

            <input
                type="date"
                name="expense_date"
                value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}"
                class="w-full border rounded px-3 py-2"
                required>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border rounded px-3 py-2">{{ old('description', $expense->description) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                Update Expense
            </button>

            <a
                href="{{ route('expenses.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection