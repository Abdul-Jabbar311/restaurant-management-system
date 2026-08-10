@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Feedback
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

<form action="{{ route('feedback.store') }}" method="POST">

    @csrf

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">
                Customer
            </label>

            <select
                name="customer_id"
                class="w-full border rounded p-2">

                <option value="">Select Customer</option>

                @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                        {{ $customer->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Rating
            </label>

            <select
                name="rating"
                class="w-full border rounded p-2">

                <option value="">Select Rating</option>

                @for($i=1;$i<=5;$i++)

                    <option
                        value="{{ $i }}"
                        {{ old('rating') == $i ? 'selected' : '' }}>

                        {{ $i }} Star

                    </option>

                @endfor

            </select>

        </div>

    </div>

    <div class="mt-6">

        <label class="block mb-2 font-semibold">
            Comment
        </label>

        <textarea
            name="comment"
            rows="5"
            class="w-full border rounded p-2">{{ old('comment') }}</textarea>

    </div>

    <div class="mt-6">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

            Save Feedback

        </button>

        <a
            href="{{ route('feedback.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

            Cancel

        </a>

    </div>

</form>

</div>

@endsection