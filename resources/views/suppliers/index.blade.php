@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Suppliers
    </h1>

    <a href="{{ route('suppliers.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Supplier
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
        placeholder="Search Supplier..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('suppliers.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full table-auto">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Name</th>
<th class="p-3 text-left">Contact Person</th>
<th class="p-3 text-left">Phone</th>
<th class="p-3 text-left">Email</th>
<th class="p-3 text-center">Status</th>
<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($suppliers as $supplier)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">
    {{ $supplier->name }}
</td>

<td class="p-3">
    {{ $supplier->contact_person }}
</td>

<td class="p-3">
    {{ $supplier->phone }}
</td>

<td class="p-3">
    {{ $supplier->email }}
</td>

<td class="p-3 text-center">

    @if($supplier->is_active)

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            Active
        </span>

    @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
            Inactive
        </span>

    @endif

</td>

<td class="p-3">

<div class="flex justify-center items-center gap-2 whitespace-nowrap">

    <a href="{{ route('suppliers.show',$supplier) }}"
       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
        View
    </a>

    <a href="{{ route('suppliers.edit',$supplier) }}"
       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
        Edit
    </a>

    <form action="{{ route('suppliers.destroy',$supplier) }}"
          method="POST"
          class="inline-flex">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            onclick="return confirm('Delete Supplier?')"
            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
            Delete
        </button>

    </form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center p-6 text-gray-500">
    No Suppliers Found.
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $suppliers->links() }}

</div>

@endsection