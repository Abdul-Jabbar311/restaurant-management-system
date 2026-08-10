@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

<div class="bg-white rounded-lg shadow p-6">

<h1 class="text-3xl font-bold mb-6">

Activity Details

</h1>

<div class="space-y-4">

<p><strong>User:</strong> {{ $activityLog->user->name }}</p>

<p><strong>Action:</strong> {{ $activityLog->action }}</p>

<p><strong>Module:</strong> {{ $activityLog->module }}</p>

<p><strong>Description:</strong> {{ $activityLog->description }}</p>

<p><strong>IP Address:</strong> {{ $activityLog->ip_address }}</p>

<p><strong>Browser:</strong> {{ $activityLog->browser }}</p>

<p><strong>Date:</strong> {{ $activityLog->created_at }}</p>

</div>

<a href="{{ route('activity-logs.index') }}"
class="inline-block mt-6 bg-gray-700 text-white px-5 py-2 rounded">

Back

</a>

</div>

</div>

@endsection