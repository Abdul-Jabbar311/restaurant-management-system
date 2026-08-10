@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Edit Coupon
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

<form action="{{ route('coupons.update', $coupon) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">
                Coupon Code
            </label>

            <input
                type="text"
                name="code"
                value="{{ old('code', $coupon->code) }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Discount (%)
            </label>

            <input
                type="number"
                name="discount_percent"
                min="1"
                max="100"
                value="{{ old('discount_percent', $coupon->discount_percent) }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Expiry Date
            </label>

            <input
                type="date"
                name="expiry_date"
                value="{{ old('expiry_date', $coupon->expiry_date) }}"
                class="w-full border rounded p-2">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="is_active"
                class="w-full border rounded p-2">

                <option value="1"
                    {{ $coupon->is_active ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ !$coupon->is_active ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

        </div>

    </div>

    <div class="mt-6">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

            Update Coupon

        </button>

        <a
            href="{{ route('coupons.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

            Cancel

        </a>

    </div>

</form>

</div>

@endsection