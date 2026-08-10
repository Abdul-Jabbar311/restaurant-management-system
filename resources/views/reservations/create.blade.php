@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Add Reservation

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

<form
action="{{ route('reservations.store') }}"
method="POST">

@csrf

<div class="grid grid-cols-2 gap-6">

<div>

<label class="block mb-2 font-semibold">

Customer

</label>

<select
name="customer_id"
class="w-full border rounded p-2">

@foreach($customers as $customer)

<option value="{{ $customer->id }}">

{{ $customer->name }}

</option>

@endforeach

</select>

</div>

<div>

<label class="block mb-2 font-semibold">

Restaurant Table

</label>

<select
name="restaurant_table_id"
class="w-full border rounded p-2">

@foreach($tables as $table)

<option value="{{ $table->id }}">

Table {{ $table->table_number }}

</option>

@endforeach

</select>

</div>

<div>

<label class="block mb-2 font-semibold">

Reservation Date

</label>

<input
type="date"
name="reservation_date"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">

Reservation Time

</label>

<input
type="time"
name="reservation_time"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">

Guests

</label>

<input
type="number"
name="number_of_guests"
class="w-full border rounded p-2">

</div>

</div>

<div class="mt-6">

<label class="block mb-2 font-semibold">

Special Request

</label>

<textarea
name="special_request"
rows="4"
class="w-full border rounded p-2"></textarea>

</div>

<div class="mt-6">

<button
type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Save Reservation

</button>

<a
href="{{ route('reservations.index') }}"
class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

Cancel

</a>

</div>

</form>

</div>

@endsection