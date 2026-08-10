@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Ingredient
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

<form action="{{ route('ingredients.store') }}" method="POST">

@csrf

<div class="grid grid-cols-2 gap-6">

<div>

<label class="block mb-2 font-semibold">
Supplier
</label>

<select
name="supplier_id"
class="w-full border rounded p-2">

@foreach($suppliers as $supplier)

<option value="{{ $supplier->id }}">

{{ $supplier->name }}

</option>

@endforeach

</select>

</div>

<div>

<label class="block mb-2 font-semibold">
Ingredient Name
</label>

<input
type="text"
name="name"
value="{{ old('name') }}"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Unit
</label>

<input
type="text"
name="unit"
value="{{ old('unit') }}"
placeholder="Kg, Liter, Piece"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Current Stock
</label>

<input
type="number"
step="0.01"
name="stock_quantity"
value="{{ old('stock_quantity') }}"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Minimum Stock
</label>

<input
type="number"
step="0.01"
name="minimum_stock"
value="{{ old('minimum_stock') }}"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Cost Per Unit
</label>

<input
type="number"
step="0.01"
name="cost_per_unit"
value="{{ old('cost_per_unit') }}"
class="w-full border rounded p-2">

</div>

</div>

<div class="mt-6">

<button
type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Save Ingredient

</button>

<a
href="{{ route('ingredients.index') }}"
class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

Cancel

</a>

</div>

</form>

</div>

@endsection