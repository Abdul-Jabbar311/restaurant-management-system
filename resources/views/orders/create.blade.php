
@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

    Create Order

</h1>

<div class="bg-white rounded-lg shadow p-6">

    <form
        action="{{ route('orders.store') }}"
        method="POST">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="block mb-2 font-semibold">

                    Customer

                </label>

                <select
                    name="customer_id"
                    class="w-full border rounded p-2">

                    @foreach($customers as $customer)

                        <option value="{{ $customer->id }}">

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
                    class="w-full border rounded p-2">

            </div>

        </div>

        <div class="mb-4 mt-6">

            <label class="block text-gray-700 font-bold mb-2">

                Restaurant Table

            </label>

            <select
                name="restaurant_table_id"
                class="w-full border rounded-lg px-4 py-3"
                required>

                <option value="">Select Table</option>

                @foreach($tables as $table)

                    <option value="{{ $table->id }}">

                        {{ $table->table_number }} - {{ $table->status }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mt-6">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                Save Order

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

