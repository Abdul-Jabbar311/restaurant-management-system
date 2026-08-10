@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Coupons
    </h1>

    <a href="{{ route('coupons.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Coupon
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
        placeholder="Search Coupon..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('coupons.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded shadow overflow-x-auto">

<table class="min-w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Code</th>
<th class="p-3 text-left">Discount</th>
<th class="p-3 text-left">Expiry Date</th>
<th class="p-3 text-left">Status</th>
<th class="p-3 text-center w-56">Actions</th>

</tr>

</thead>

<tbody>

@forelse($coupons as $coupon)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">
    {{ $coupon->code }}
</td>

<td class="p-3">
    {{ $coupon->discount_percent }}%
</td>

<td class="p-3">
    {{ $coupon->expiry_date }}
</td>

<td class="p-3">

    @if($coupon->is_active)

        <span class="text-green-600 font-semibold">
            Active
        </span>

    @else

        <span class="text-red-600 font-semibold">
            Inactive
        </span>

    @endif

</td>

<td class="p-3">

<div class="flex justify-center gap-2 whitespace-nowrap">

<a href="{{ route('coupons.show',$coupon) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
View
</a>

<a href="{{ route('coupons.edit',$coupon) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
Edit
</a>

<form
action="{{ route('coupons.destroy',$coupon) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Delete Coupon?')"
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

No Coupons Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $coupons->links() }}

</div>

@endsection