@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Notifications
    </h1>

    <a href="{{ route('notifications.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

        + New Notification

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-lg shadow overflow-hidden">

<table class="min-w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3 text-left">Title</th>
<th class="p-3 text-left">Status</th>
<th class="p-3 text-left">Created</th>
<th class="p-3 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($notifications as $notification)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 font-medium">

{{ $notification->title }}

</td>

<td class="p-3">

@if($notification->is_read)

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

Read

</span>

@else

<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

Unread

</span>

@endif

</td>

<td class="p-3">

{{ $notification->created_at->format('d M Y') }}

</td>

<td class="p-3">

<div class="flex justify-center gap-2">

<a href="{{ route('notifications.show',$notification) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

View

</a>

<a href="{{ route('notifications.edit',$notification) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

Edit

</a>

<form action="{{ route('notifications.destroy',$notification) }}"
method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Delete Notification?')"
class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center p-6">

No Notifications Found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $notifications->links() }}

</div>

@endsection