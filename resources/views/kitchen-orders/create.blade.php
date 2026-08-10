@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Kitchen Order
</h1>

@if($errors->any())

<div class="bg-red-100 text-red-700 p-4 rounded mb-4">

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('kitchen-orders.store') }}" method="POST">

    @csrf

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">
                Order
            </label>

            <select
                name="order_id"
                class="w-full border rounded p-2">

                @foreach($orders as $order)

                    <option value="{{ $order->id }}">
                        Order #{{ $order->id }}
                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded p-2">

                <option value="Pending">Pending</option>
                <option value="Preparing">Preparing</option>
                <option value="Ready">Ready</option>
                <option value="Served">Served</option>

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Started At
            </label>

            <input
                type="datetime-local"
                name="started_at"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Completed At
            </label>

            <input
                type="datetime-local"
                name="completed_at"
                class="w-full border rounded p-2">

        </div>

    </div>

    <div class="mt-6">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

            Save Kitchen Order

        </button>

        <a
            href="{{ route('kitchen-orders.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

            Cancel

        </a>

    </div>

</form>

</div>

@endsection