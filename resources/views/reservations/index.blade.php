@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Reservations
    </h1>

    <a href="{{ route('reservations.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Reservation
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
        placeholder="Search Customer / Table..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('reservations.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full table-auto">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Customer</th>
<th class="p-3 text-center">Table</th>
<th class="p-3 text-center">Date</th>
<th class="p-3 text-center">Time</th>
<th class="p-3 text-center">Guests</th>
<th class="p-3 text-center">Status</th>
<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($reservations as $reservation)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">
    {{ $reservation->customer->name }}
</td>

<td class="p-3 text-center">
    Table {{ $reservation->table->table_number }}
</td>

<td class="p-3 text-center">
    {{ $reservation->reservation_date }}
</td>

<td class="p-3 text-center">
    {{ $reservation->reservation_time }}
</td>

<td class="p-3 text-center">
    {{ $reservation->number_of_guests }}
</td>

<td class="p-3 text-center">

    @if($reservation->status == 'Pending')

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
            Pending
        </span>

    @elseif($reservation->status == 'Confirmed')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            Confirmed
        </span>

    @elseif($reservation->status == 'Cancelled')

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
            Cancelled
        </span>

    @else

        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
            {{ $reservation->status }}
        </span>

    @endif

</td>

<td class="p-3">

<div class="flex justify-center items-center gap-2 whitespace-nowrap">

<a href="{{ route('reservations.show', $reservation) }}"
   class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
    View
</a>

<a href="{{ route('reservations.edit', $reservation) }}"
   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
    Edit
</a>

<form action="{{ route('reservations.destroy', $reservation) }}"
      method="POST"
      class="inline-flex">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        onclick="return confirm('Delete Reservation?')"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
        Delete
    </button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center p-6 text-gray-500">
    No Reservations Found.
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $reservations->links() }}

</div>

@endsection