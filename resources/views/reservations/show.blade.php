@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow-lg p-8">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">
            Reservation Details
        </h1>

        <a href="{{ route('reservations.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

            Back

        </a>

    </div>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-gray-50 p-5 rounded-xl">
            <p class="text-gray-500">Customer</p>
            <h2 class="text-xl font-bold">
                {{ $reservation->customer->name }}
            </h2>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <p class="text-gray-500">Table</p>
            <h2 class="text-xl font-bold">
                {{ $reservation->restaurantTable?->table_number ?? 'Table not found' }}
            </h2>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <p class="text-gray-500">Date</p>
            <h2 class="text-xl font-bold">
                {{ $reservation->reservation_date->format('d M Y') }}
            </h2>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <p class="text-gray-500">Time</p>
            <h2 class="text-xl font-bold">
                {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}
            </h2>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <p class="text-gray-500">Guests</p>
            <h2 class="text-xl font-bold">
                {{ $reservation->number_of_guests }}
            </h2>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <p class="text-gray-500">Status</p>

            <span class="inline-block mt-2 bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">
                {{ $reservation->status }}
            </span>

        </div>

    </div>

    <div class="mt-6 bg-gray-50 p-5 rounded-xl">

        <p class="text-gray-500">
            Special Request
        </p>

        <p class="mt-2 font-semibold">
            {{ $reservation->special_request ?: 'No special request' }}
        </p>

    </div>

</div>

@endsection