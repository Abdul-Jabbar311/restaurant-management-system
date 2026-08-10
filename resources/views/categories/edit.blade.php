@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Edit Category
</h1>

<form method="POST"
      action="{{ route('categories.update',$category) }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-2">Category Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name',$category->name) }}"
            class="w-full border rounded p-3">
    </div>

    <div class="mb-4">
        <label class="block mb-2">Description</label>

        <textarea
            name="description"
            rows="4"
            class="w-full border rounded p-3">{{ old('description',$category->description) }}</textarea>
    </div>

    @if($category->image)

        <img
            src="{{ asset('storage/'.$category->image) }}"
            class="w-24 h-24 rounded mb-4">

    @endif

    <div class="mb-6">

        <label class="block mb-2">New Image</label>

        <input
            type="file"
            name="image"
            class="w-full">

    </div>

    <button
        class="bg-blue-600 text-white px-6 py-3 rounded">

        Update Category

    </button>

</form>

@endsection