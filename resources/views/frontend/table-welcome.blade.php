@extends('frontend.layouts.app')

@section('title', 'Welcome')

@section('content')

<section class="min-h-screen flex items-center justify-center bg-linear-to-br from-red-600 via-red-500 to-orange-500">

    <div class="bg-white rounded-3xl shadow-2xl p-10 max-w-lg w-full text-center animate-fade">

        <div class="text-7xl mb-5">
            🍽️
        </div>

        <h1 class="text-4xl font-extrabold text-gray-800 mb-3">
            Welcome!
        </h1>

        <p class="text-lg text-gray-500 mb-2">
            You're dining at
        </p>

        <div class="inline-block bg-red-100 text-red-600 px-8 py-4 rounded-2xl text-3xl font-bold mb-6">
            Table {{ $table->table_number }}
        </div>

        <p class="text-gray-600 leading-7 mb-8">
            Scan successful 🎉

            <br>

            Your orders will automatically be sent to this table.

            <br>

            No need to call a waiter.
        </p>

        <a href="{{ route('menu') }}"
           class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white text-xl font-semibold px-10 py-4 rounded-full shadow-lg hover:scale-105 transition duration-300">

            🍔 Start Ordering

        </a>

    </div>

</section>

@endsection