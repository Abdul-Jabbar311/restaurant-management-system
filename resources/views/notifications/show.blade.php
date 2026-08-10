@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Notification Details

</h1>

<div class="bg-white rounded shadow p-6">

<h2 class="text-2xl font-semibold mb-4">

{{ $notification->title }}

</h2>

<p class="text-gray-700 mb-6">

{{ $notification->message }}

</p>

<div class="flex gap-4">

@if($notification->is_read)

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

Read

</span>

@else

<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

Unread

</span>

@endif

<span class="text-gray-500">

{{ $notification->created_at->format('d M Y h:i A') }}

</span>

</div>

</div>

@endsection