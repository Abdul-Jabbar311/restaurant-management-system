@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Edit Order

</h1>

<div class="bg-white rounded-lg shadow p-6">

<form
action="{{ route('orders.update',$order) }}"
method="POST">

@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-6">

<div>

<label class="block mb-2 font-semibold">

Customer

</label>

<select
name="customer_id"
class="w-full border rounded p-2">

@foreach($customers as $customer)

<option
value="{{ $customer->id }}"
{{ $customer->id==$order->customer_id ? 'selected':'' }}>

{{ $customer->name }}

</option>

@endforeach

</select>

</div>

<div>

<label class="block mb-2 font-semibold">

Total Amount

</label>

<input
type="number"
step="0.01"
name="total_amount"
value="{{ $order->total_amount }}"
class="w-full border rounded p-2">

</div>

</div>
<div class="mb-3">
    <label class="form-label">Order Status</label>

    <select name="status" class="form-control">

        <option value="Pending"
            {{ $order->status == 'Pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="Preparing"
            {{ $order->status == 'Preparing' ? 'selected' : '' }}>
            Preparing
        </option>

        <option value="Ready"
            {{ $order->status == 'Ready' ? 'selected' : '' }}>
            Ready
        </option>

        <option value="Completed"
            {{ $order->status == 'Completed' ? 'selected' : '' }}>
            Completed
        </option>

    </select>

</div>

<div class="mt-6">

<button
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

Update Order

</button>

<a
href="{{ route('orders.index') }}"
class="ml-3 bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">

Cancel

</a>

</div>

</form>

</div>

@endsection