@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Contact Message
</h1>

<div class="bg-white shadow rounded p-6">

<p><strong>Name:</strong> {{ $contact->name }}</p>

<p class="mt-3"><strong>Email:</strong> {{ $contact->email }}</p>

<p class="mt-3"><strong>Phone:</strong> {{ $contact->phone }}</p>

<p class="mt-3"><strong>Subject:</strong> {{ $contact->subject }}</p>

<p class="mt-3"><strong>Message:</strong></p>

<div class="mt-2 border rounded p-4 bg-gray-50">
    {{ $contact->message }}
</div>

</div>

@endsection