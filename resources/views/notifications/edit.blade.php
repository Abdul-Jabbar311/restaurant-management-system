@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Edit Notification

</h1>

<form method="POST"
action="{{ route('notifications.update',$notification) }}"
class="bg-white p-6 rounded shadow">

@csrf
@method('PUT')

<div class="mb-4">

<label class="font-semibold">

Title

</label>

<input
type="text"
name="title"
value="{{ $notification->title }}"
class="w-full border rounded px-4 py-2 mt-2"
required>

</div>

<div class="mb-6">

<label class="font-semibold">

Message

</label>

<textarea
name="message"
rows="6"
class="w-full border rounded px-4 py-2 mt-2"
required>{{ $notification->message }}</textarea>

</div>

<button
class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">

Update Notification

</button>

</form>

@endsection