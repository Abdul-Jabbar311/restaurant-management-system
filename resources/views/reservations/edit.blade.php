@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow-lg p-8">

    <h1 class="text-3xl font-bold mb-6">
        Edit Reservation
    </h1>

    <form action="{{ route('reservations.update', $reservation) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Customer -->
            <div>
                <label class="block font-semibold mb-2">
                    Customer
                </label>

                <select name="customer_id"
                        class="w-full border rounded-lg px-4 py-3"
                        required>

                    @foreach($customers as $customer)

                        <option value="{{ $customer->id }}"
                            {{ $reservation->customer_id == $customer->id ? 'selected' : '' }}>

                            {{ $customer->name }}

                        </option>

                    @endforeach

                </select>
            </div>

            <!-- Table -->
            <div>
                <label class="block font-semibold mb-2">
                    Restaurant Table
                </label>

                <select name="restaurant_table_id"
                        class="w-full border rounded-lg px-4 py-3"
                        required>

                    @foreach($tables as $table)

                        <option value="{{ $table->id }}"
                            {{ $reservation->restaurant_table_id == $table->id ? 'selected' : '' }}>

                            {{ $table->table_number }}

                        </option>

                    @endforeach

                </select>
            </div>

            <!-- Date -->
            <div>
                <label class="block font-semibold mb-2">
                    Reservation Date
                </label>

                <input
                    type="date"
                    name="reservation_date"
                    value="{{ $reservation->reservation_date->format('Y-m-d') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>

            <!-- Time -->
            <div>
                <label class="block font-semibold mb-2">
                    Reservation Time
                </label>

                <input
                    type="time"
                    name="reservation_time"
                    value="{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>

            <!-- Guests -->
            <div>
                <label class="block font-semibold mb-2">
                    Number of Guests
                </label>

                <input
                    type="number"
                    name="number_of_guests"
                    value="{{ $reservation->number_of_guests }}"
                    min="1"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>

        </div>

        <!-- Special Request -->
        <div class="mt-6">

            <label class="block font-semibold mb-2">
                Special Request
            </label>

            <textarea
                name="special_request"
                rows="4"
                class="w-full border rounded-lg px-4 py-3">{{ $reservation->special_request }}</textarea>

        </div>

        <!-- Buttons -->
        <div class="flex gap-4 mt-8">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">

                Update Reservation

            </button>

            <a
                href="{{ route('reservations.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection