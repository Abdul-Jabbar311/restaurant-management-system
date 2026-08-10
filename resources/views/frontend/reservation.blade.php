@extends('frontend.layouts.app')

@section('title', 'Table Reservation')

@section('content')

<section class="bg-gray-50 py-16">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- Left -->

            <div>

                <span class="text-red-600 font-semibold uppercase tracking-widest">
                    Reserve Your Table
                </span>

                <h1 class="text-5xl font-bold text-gray-900 mt-4 leading-tight">
                    Book A Table For
                    <span class="text-red-600">
                        Your Family
                    </span>
                </h1>

                <p class="mt-6 text-gray-600 leading-8">
                    Reserve your table in advance and enjoy delicious food,
                    quick service and a wonderful dining experience with your
                    family and friends.
                </p>

                <div class="mt-10 grid grid-cols-2 gap-6">

                    <div class="bg-white rounded-xl shadow p-5">

                        <h3 class="font-bold text-lg">
                            Opening Hours
                        </h3>

                        <p class="text-gray-600 mt-3">
                            Monday - Sunday
                        </p>

                        <p class="font-semibold">
                            10:00 AM - 11:00 PM
                        </p>

                    </div>

                    <div class="bg-white rounded-xl shadow p-5">

                        <h3 class="font-bold text-lg">
                            Contact
                        </h3>

                        <p class="text-gray-600 mt-3">
                            +92 300 1234567
                        </p>

                        <p>
                            restaurant@email.com
                        </p>

                    </div>

                </div>

            </div>

            <!-- Right -->

            <div class="bg-white rounded-3xl shadow-xl p-8">

                <h2 class="text-3xl font-bold mb-8">
                    Reservation Form
                </h2>

                @if(session('success'))

                    <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-lg">

                        {{ session('success') }}

                    </div>

                @endif

                <form
                    action="{{ route('reservation.store') }}"
                    method="POST"
                    class="space-y-6">

                    @csrf

                    <div>

                        <label class="block mb-2 font-medium">

                            Full Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:outline-none">

                        @error('name')

                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>

                            <label class="block mb-2 font-medium">

                                Phone

                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                        <div>

                            <label class="block mb-2 font-medium">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>

                            <label class="block mb-2 font-medium">

                                Reservation Date

                            </label>

                            <input
                                type="date"
                                name="reservation_date"
                                value="{{ old('reservation_date') }}"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                        <div>

                            <label class="block mb-2 font-medium">

                                Reservation Time

                            </label>

                            <input
                                type="time"
                                name="reservation_time"
                                value="{{ old('reservation_time') }}"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">

                            Number Of Guests

                        </label>

                        <select
                            name="number_of_guests"
                            class="w-full border rounded-xl px-4 py-3">

                            @for($i=1;$i<=20;$i++)

                                <option value="{{ $i }}">

                                    {{ $i }} Guest{{ $i>1 ? 's' : '' }}

                                </option>

                            @endfor

                        </select>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">

                            Special Request

                        </label>

                        <textarea
                            rows="4"
                            name="special_request"
                            class="w-full border rounded-xl px-4 py-3">{{ old('special_request') }}</textarea>

                    </div>

                  <button
    type="submit"
    class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-xl font-semibold transition">
                        Reserve Table

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection