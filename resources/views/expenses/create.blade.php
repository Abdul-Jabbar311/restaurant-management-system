@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Expense
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

<form action="{{ route('expenses.store') }}" method="POST">

    @csrf

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">
                Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Category
            </label>

            <select
                name="category"
                class="w-full border rounded p-2">

                <option value="">Select Category</option>
                <option value="Electricity">Electricity</option>
                <option value="Gas">Gas</option>
                <option value="Salary">Salary</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Rent">Rent</option>
                <option value="Other">Other</option>

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Amount
            </label>

            <input
                type="number"
                step="0.01"
                name="amount"
                value="{{ old('amount') }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Expense Date
            </label>

            <input
                type="date"
                name="expense_date"
                value="{{ old('expense_date') }}"
                class="w-full border rounded p-2">

        </div>

    </div>

    <div class="mt-6">

        <label class="block mb-2 font-semibold">
            Description
        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full border rounded p-2">{{ old('description') }}</textarea>

    </div>

    <div class="mt-6">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

            Save Expense

        </button>

        <a
            href="{{ route('expenses.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

            Cancel

        </a>

    </div>

</form>

</div>

@endsection