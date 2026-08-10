@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Edit Menu Item
</h1>

@if ($errors->any())

<div class="bg-red-100 text-red-700 p-4 rounded mb-4">

    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('menu-items.update', $menuItem) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-6">

    <div>

        <label class="block mb-2 font-semibold">
            Category
        </label>

        <select
            name="category_id"
            class="w-full border rounded p-2">

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div>

        <label class="block mb-2 font-semibold">
            Menu Name
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $menuItem->name) }}"
            class="w-full border rounded p-2">

    </div>

    <div>

        <label class="block mb-2 font-semibold">
            Price
        </label>

        <input
            type="number"
            step="0.01"
            name="price"
            value="{{ old('price', $menuItem->price) }}"
            class="w-full border rounded p-2">

    </div>

    <div>

        <label class="block mb-2 font-semibold">
            Preparation Time (Minutes)
        </label>

        <input
            type="number"
            name="preparation_time"
            value="{{ old('preparation_time', $menuItem->preparation_time) }}"
            class="w-full border rounded p-2">

    </div>

</div>

<div class="mt-6">

<label class="block mb-2 font-semibold">

Description

</label>

<textarea
name="description"
rows="4"
class="w-full border rounded p-2">{{ old('description', $menuItem->description) }}</textarea>

</div>

<div class="mt-6">

<label class="block mb-2 font-semibold">

Image

</label>

<input
type="file"
name="image"
class="w-full border rounded p-2">

@if($menuItem->image)

<img
src="{{ asset('storage/'.$menuItem->image) }}"
class="w-24 mt-4 rounded">

@endif

</div>

<div class="mt-6">

<button
type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Update Menu Item

</button>

<a href="{{ route('menu-items.index') }}"
class="ml-3 bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">

Cancel

</a>

</div>

</form>

</div>

@endsection