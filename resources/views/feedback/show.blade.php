@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">
            Feedback Details
        </h2>

        <a href="{{ route('feedback.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

    <div class="space-y-4">

        <div>
            <strong>Customer:</strong>
            {{ $feedback->customer->name ?? 'N/A' }}
        </div>

        <div>
            <strong>Rating:</strong>

            <span class="text-yellow-500 font-bold">
                {{ $feedback->rating }} / 5
            </span>
        </div>

        <div>
            <strong>Comment:</strong>

            <p class="mt-2 bg-gray-100 p-4 rounded">
                {{ $feedback->comment }}
            </p>
        </div>

        <div>
            <strong>Submitted:</strong>
            {{ $feedback->created_at->format('d M Y, h:i A') }}
        </div>

    </div>

</div>

@endsection