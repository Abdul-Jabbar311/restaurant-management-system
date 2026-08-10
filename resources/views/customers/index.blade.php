@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Customers
    </h1>

    <a href="{{ route('customers.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

        + Add Customer

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3">Name</th>
<th class="p-3">Phone</th>
<th class="p-3">Email</th>
<th class="p-3">Points</th>
<th class="p-3">Actions</th>

</tr>

</thead>

<tbody>

@forelse($customers as $customer)

<tr class="border-t">

<td class="p-3">{{ $customer->name }}</td>

<td class="p-3">{{ $customer->phone }}</td>

<td class="p-3">{{ $customer->email }}</td>

<td class="p-3">{{ $customer->loyalty_points }}</td>

<td class="p-3">

<div class="flex justify-center gap-2">

<a href="{{ route('customers.edit',$customer) }}"
class="bg-yellow-500 text-white px-3 py-1 rounded">

Edit

</a>

<form
action="{{ route('customers.destroy',$customer) }}"
method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Delete Customer?')"
class="bg-red-600 text-white px-3 py-1 rounded">

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center p-5">

No Customers Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection