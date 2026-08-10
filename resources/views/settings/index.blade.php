@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Settings
    </h1>

    <a href="{{ route('settings.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        + Add Settings
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
        placeholder="Search Restaurant..."
        class="border rounded px-4 py-2 w-72">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Search
    </button>

    <a href="{{ route('settings.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Reset
    </a>

</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Restaurant</th>
<th class="p-3 text-left">Phone</th>
<th class="p-3 text-left">Email</th>
<th class="p-3 text-left">Tax %</th>
<th class="p-3 text-left">Currency</th>
<th class="p-3 text-left">Logo</th>
<th class="p-3 text-center w-64">Actions</th>

</tr>

</thead>

<tbody>

@forelse($settings as $setting)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">

{{ $setting->restaurant_name }}

</td>

<td class="p-3">

{{ $setting->phone }}

</td>

<td class="p-3">

{{ $setting->email }}

</td>

<td class="p-3">

{{ $setting->tax_percentage }}%

</td>

<td class="p-3">

{{ $setting->currency }}

</td>

<td class="p-3">

@if($setting->logo)

<img
src="{{ asset('storage/'.$setting->logo) }}"
class="w-16 h-16 rounded object-cover">

@else

<span class="text-gray-500">

No Logo

</span>

@endif

</td>

<td class="p-3">

<div class="flex justify-center gap-2 whitespace-nowrap">

<a
href="{{ route('settings.show',$setting) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">

View

</a>

<a
href="{{ route('settings.edit',$setting) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">

Edit

</a>

<form
action="{{ route('settings.destroy',$setting) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Delete Settings?')"
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

No Settings Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $settings->links() }}

</div>

@endsection