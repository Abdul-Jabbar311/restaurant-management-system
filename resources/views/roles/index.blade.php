@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Roles
    </h1>

    <a href="{{ route('roles.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Role
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
        placeholder="Search Role..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('roles.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full table-auto">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-left">
ID
</th>

<th class="p-4 text-left">
Role Name
</th>

<th class="p-4 text-left">
Description
</th>

<th class="p-4 text-center">
Users
</th>

<th class="p-4 text-center w-64">
Actions
</th>

</tr>

</thead>

<tbody>

@forelse($roles as $role)

<tr class="border-t hover:bg-gray-50">

<td class="p-4">

{{ $role->id }}

</td>

<td class="p-4 font-semibold">

{{ $role->name }}

</td>

<td class="p-4">

{{ $role->description }}

</td>

<td class="p-4 text-center">

{{ $role->users->count() }}

</td>

<td class="p-4">

<div class="flex justify-center items-center gap-2 whitespace-nowrap">

<a
href="{{ route('roles.show',$role) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">

View

</a>

<a
href="{{ route('roles.edit',$role) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">

Edit

</a>

<form
action="{{ route('roles.destroy',$role) }}"
method="POST"
class="inline-flex">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Delete this role?')"
class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center p-6 text-gray-500">

No Roles Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $roles->links() }}

</div>

@endsection