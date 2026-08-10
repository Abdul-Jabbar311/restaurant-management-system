@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Add Category

</h1>

<form method="POST"
      action="{{ route('categories.store') }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow">

@csrf

<div class="mb-4">

<label class="block mb-2">

Category Name

</label>

<input
type="text"
name="name"
class="w-full border rounded p-3"
required>

</div>

<div class="mb-4">

<label class="block mb-2">

Description

</label>

<textarea
name="description"
rows="4"
class="w-full border rounded p-3"></textarea>

</div>

<div class="mb-6">

<label class="block mb-2">

Image

</label>

<input
type="file"
name="image"
class="w-full border rounded p-2">

</div>

<button
type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">

Save Category

</button>

</form>

@endsection