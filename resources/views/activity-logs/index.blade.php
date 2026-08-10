@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Activity Logs
    </h1>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3 text-left">User</th>
<th class="p-3 text-left">Action</th>
<th class="p-3 text-left">Module</th>
<th class="p-3 text-left">Date</th>
<th class="p-3 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($activityLogs as $log)

<tr class="border-t">

<td class="p-3">
    {{ $log->user->name }}
</td>

<td class="p-3">
    {{ $log->action }}
</td>

<td class="p-3">
    {{ $log->module }}
</td>

<td class="p-3">
    {{ $log->created_at->format('d M Y H:i') }}
</td>

<td class="p-3 text-center">

<a href="{{ route('activity-logs.show',$log) }}"
class="bg-blue-500 text-white px-3 py-1 rounded">

View

</a>

<form action="{{ route('activity-logs.destroy',$log) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
class="bg-red-600 text-white px-3 py-1 rounded">

Delete

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="5"
class="text-center py-6">

No Activity Found

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="p-4">

{{ $activityLogs->links() }}

</div>

</div>

@endsection