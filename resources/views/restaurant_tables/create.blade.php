@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Add Restaurant Table

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

<form action="{{ route('restaurant-tables.store') }}" method="POST">

@csrf

<div class="grid grid-cols-2 gap-6">

<div>

<label class="block mb-2 font-semibold">Table Number</label>

<input
type="text"
name="table_number"
class="w-full border rounded p-2"
required>

</div>

<div>

<label class="block mb-2 font-semibold">Table Name</label>

<input
type="text"
name="table_name"
class="w-full border rounded p-2"
required>

</div>

<div>

<label class="block mb-2 font-semibold">Capacity</label>

<input
type="number"
name="capacity"
class="w-full border rounded p-2"
required>

</div>

<div>

<label class="block mb-2 font-semibold">Location</label>

<input
type="text"
name="location"
class="w-full border rounded p-2"
required>

</div>

</div>

<div class="mt-6">

<button
type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Save Table

</button>

<a
href="{{ route('restaurant-tables.index') }}"
class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

Cancel

</a>

</div>

</form>

</div>

@endsection