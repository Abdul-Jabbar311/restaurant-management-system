@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Customer Feedback
    </h1>

    <a href="{{ route('feedback.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Feedback
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
        placeholder="Search Customer..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('feedback.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded shadow overflow-x-auto">

<table class="min-w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Customer</th>
<th class="p-3 text-left">Rating</th>
<th class="p-3 text-left">Comment</th>
<th class="p-3 text-left">Date</th>
<th class="p-3 text-center w-56">Actions</th>

</tr>

</thead>

<tbody>

@forelse($feedback as $item)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">

    {{ $item->customer->name }}

</td>

<td class="p-3">

    ⭐ {{ $item->rating }}/5

</td>

<td class="p-3">

    {{ $item->comment }}

</td>

<td class="p-3">

    {{ $item->created_at->format('d M Y') }}

</td>

<td class="p-3">

<div class="flex justify-center gap-2 whitespace-nowrap">

<a href="{{ route('feedback.show',$item) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
View
</a>

<a href="{{ route('feedback.edit',$item) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
Edit
</a>

<form
action="{{ route('feedback.destroy',$item) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Delete Feedback?')"
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

No Feedback Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $feedback->links() }}

</div>

@endsection