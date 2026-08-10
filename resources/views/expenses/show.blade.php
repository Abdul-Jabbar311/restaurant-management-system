@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold">
            Expense Details
        </h2>

        <a href="{{ route('expenses.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
            Back
        </a>

    </div>

    <div class="space-y-5">

        <div>
            <p class="text-gray-500">Title</p>
            <p class="text-lg font-semibold">
                {{ $expense->title }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Category</p>
            <p class="text-lg">
                {{ $expense->category }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Amount</p>
            <p class="text-xl font-bold text-red-600">
                Rs. {{ number_format($expense->amount, 2) }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Expense Date</p>
            <p>
                {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Description</p>

            <div class="bg-gray-100 rounded p-4">
                {{ $expense->description ?? 'No description' }}
            </div>
        </div>

    </div>

</div>

@endsection