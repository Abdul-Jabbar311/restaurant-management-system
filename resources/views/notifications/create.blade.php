@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Create Notification

</h1>

<form method="POST"
action="{{ route('notifications.store') }}"
class="bg-white p-6 rounded shadow">

@csrf

<div class="mb-4">

<label class="font-semibold">

Title

</label>

<input
type="text"
name="title"
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
required></textarea>

</div>

<button
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Save Notification

</button>

</form>

@endsection