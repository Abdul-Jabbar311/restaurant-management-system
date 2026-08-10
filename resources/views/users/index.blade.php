@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Users
    </h1>

    <div class="flex gap-3">

        <a href="{{ route('export.users') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">
            Export PDF
        </a>

        <a href="{{ route('users.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
            Add User
        </a>

    </div>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
    {{ session('success') }}
</div>

@endif

<form method="GET" class="flex flex-wrap gap-3 mb-6">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search name, email or phone..."
        class="border rounded-lg px-4 py-2 w-72">

    <select
        name="role"
        class="border rounded-lg px-4 py-2">

        <option value="">All Roles</option>

        <option value="Admin" {{ request('role')=='Admin' ? 'selected' : '' }}>Admin</option>

        <option value="Manager" {{ request('role')=='Manager' ? 'selected' : '' }}>Manager</option>

        <option value="Waiter" {{ request('role')=='Waiter' ? 'selected' : '' }}>Waiter</option>

        <option value="Chef" {{ request('role')=='Chef' ? 'selected' : '' }}>Chef</option>

    </select>

    <select
        name="status"
        class="border rounded-lg px-4 py-2">

        <option value="">All Status</option>

        <option value="1" {{ request('status')==='1' ? 'selected' : '' }}>
            Active
        </option>

        <option value="0" {{ request('status')==='0' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

        Search

    </button>

    <a href="{{ route('users.index') }}"
       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

        Reset

    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full table-auto">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Image</th>
<th class="p-3 text-left">Name</th>
<th class="p-3 text-left">Email</th>
<th class="p-3 text-left">Phone</th>
<th class="p-3 text-center">Role</th>
<th class="p-3 text-center">Status</th>
<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($users as $user)

<tr class="border-t hover:bg-gray-50">

<td class="p-3">

@if($user->profile_image)

<img src="{{ asset('storage/'.$user->profile_image) }}"
class="w-12 h-12 rounded-full object-cover">

@else

<div class="w-12 h-12 rounded-full bg-gray-300"></div>

@endif

</td>

<td class="p-3 font-medium">

{{ $user->name }}

</td>

<td class="p-3">

{{ $user->email }}

</td>

<td class="p-3">

{{ $user->phone }}

</td>

<td class="p-3 text-center">

{{ $user->role->name }}

</td>

<td class="p-3 text-center">

@if($user->is_active)

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

<a href="{{ route('users.show',$user) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">

View

</a>

<a href="{{ route('users.edit',$user) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">

Edit

</a>

<form action="{{ route('users.destroy',$user) }}"
method="POST"
class="inline-flex">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Delete User?')"
class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7"
class="text-center p-6 text-gray-500">

No Users Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $users->withQueryString()->links() }}

</div>

@endsection