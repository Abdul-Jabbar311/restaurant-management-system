@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Menu Items
    </h1>

    <a href="{{ route('menu-items.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Menu Item
    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif

<form method="GET" class="mb-5 flex gap-2">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search Menu Item..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('menu-items.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Image</th>

<th class="p-3 text-left">Name</th>

<th class="p-3 text-left">Category</th>

<th class="p-3 text-left">Price</th>

<th class="p-3 text-left">Preparation Time</th>

<th class="p-3 text-left">Available</th>

<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($menuItems as $item)

<tr class="border-t hover:bg-gray-50">

<td class="p-3">

@if($item->image)

<img
src="{{ asset('storage/'.$item->image) }}"
class="w-16 h-16 object-cover rounded">

@else

<span class="text-gray-500">
No Image
</span>

@endif

</td>

<td class="p-3 font-medium">

{{ $item->name }}

</td>

<td class="p-3">

{{ $item->category->name }}

</td>

<td class="p-3">

Rs. {{ number_format($item->price,2) }}

</td>

<td class="p-3">

{{ $item->preparation_time }} min

</td>

<td class="p-3">

@if($item->is_available)

<span class="text-green-600 font-semibold">

Available

</span>

@else

<span class="text-red-600 font-semibold">

Unavailable

</span>

@endif

</td>

<td class="p-3">

<div class="flex justify-center gap-2 whitespace-nowrap">

<a
href="{{ route('menu-items.show',$item) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">

View

</a>

<a
href="{{ route('menu-items.edit',$item) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">

Edit

</a>

<form
action="{{ route('menu-items.destroy',$item) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Delete this item?')"
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

No Menu Items Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $menuItems->links() }}

</div>

@endsection