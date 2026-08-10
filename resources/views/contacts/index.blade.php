@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Contact Messages
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded overflow-x-auto">

<table class="min-w-full">

<thead class="bg-gray-200">

<tr>

<th class="p-3">Name</th>
<th class="p-3">Email</th>
<th class="p-3">Subject</th>
<th class="p-3">Date</th>
<th class="p-3">Action</th>

</tr>

</thead>

<tbody>

@foreach($contacts as $contact)

<tr class="border-t">

<td class="p-3">{{ $contact->name }}</td>
<td class="p-3">{{ $contact->email }}</td>
<td class="p-3">{{ $contact->subject }}</td>
<td class="p-3">{{ $contact->created_at->format('d M Y') }}</td>

<td class="p-3 flex gap-2">

<a href="{{ route('contacts.show',$contact) }}"
class="bg-green-600 text-white px-3 py-1 rounded">
View
</a>

<form action="{{ route('contacts.destroy',$contact) }}" method="POST">

@csrf
@method('DELETE')

<button class="bg-red-600 text-white px-3 py-1 rounded">
Delete
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-6">

{{ $contacts->links() }}

</div>

@endsection