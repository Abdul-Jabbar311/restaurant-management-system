@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Supplier
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

<form action="{{ route('suppliers.store') }}" method="POST">

@csrf

<div class="grid grid-cols-2 gap-6">

<div>

<label class="block mb-2 font-semibold">
Name
</label>

<input
type="text"
name="name"
value="{{ old('name') }}"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Contact Person
</label>

<input
type="text"
name="contact_person"
value="{{ old('contact_person') }}"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Phone
</label>

<input
type="text"
name="phone"
value="{{ old('phone') }}"
class="w-full border rounded p-2">

</div>

<div>

<label class="block mb-2 font-semibold">
Email
</label>

<input
type="email"
name="email"
value="{{ old('email') }}"
class="w-full border rounded p-2">

</div>

</div>

<div class="mt-6">

<label class="block mb-2 font-semibold">
Address
</label>

<textarea
name="address"
rows="4"
class="w-full border rounded p-2">{{ old('address') }}</textarea>

</div>

<div class="mt-6">

<button
type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Save Supplier

</button>

<a
href="{{ route('suppliers.index') }}"
class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

Cancel

</a>

</div>

</form>

</div>

@endsection