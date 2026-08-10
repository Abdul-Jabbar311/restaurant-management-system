@extends('frontend.layouts.app')

@section('title', 'Customer Feedback')

@section('content')

<!-- Hero -->

<section class="bg-orange-600 py-20 text-white">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h1 class="text-5xl font-extrabold">

            Customer Feedback

        </h1>

        <p class="mt-6 text-xl text-orange-100 max-w-3xl mx-auto">

            Your feedback helps us improve our food and service.
            We'd love to hear about your experience.

        </p>

    </div>

</section>

<!-- Rating Summary -->

<section class="py-16 bg-orange-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-4 gap-8">

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h2 class="text-5xl font-bold text-orange-600">

                    4.9

                </h2>

                <div class="text-yellow-400 text-2xl mt-3">

                    ★★★★★

                </div>

                <p class="mt-3 text-gray-500">

                    Overall Rating

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h2 class="text-5xl font-bold text-green-600">

                    2,500+

                </h2>

                <p class="mt-4 text-gray-500">

                    Happy Customers

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h2 class="text-5xl font-bold text-blue-600">

                    98%

                </h2>

                <p class="mt-4 text-gray-500">

                    Positive Reviews

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h2 class="text-5xl font-bold text-red-600">

                    15K+

                </h2>

                <p class="mt-4 text-gray-500">

                    Orders Served

                </p>

            </div>

        </div>

    </div>

</section>
@if(session('success'))

<div class="mb-6 bg-green-100 text-green-700 p-4 rounded">

    {{ session('success') }}

</div>

@endif

<!-- Feedback Form -->

<section class="py-20 bg-white">

    <div class="max-w-5xl mx-auto px-6">

        <div class="bg-white shadow-xl rounded-3xl p-10">

            <h2 class="text-3xl font-bold mb-8 text-center">

                Leave Your Review

            </h2>

            <form action="{{ route('feedback.store') }}" method="POST">

                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="font-semibold block mb-2">

                            Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500">

                    </div>

                    <div>

                        <label class="font-semibold block mb-2">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500">

                    </div>

                </div>

                <div class="mt-6">

                    <label class="font-semibold block mb-3">

                        Rating

                    </label>

                    <select
                        name="rating"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="5">★★★★★ Excellent</option>

                        <option value="4">★★★★☆ Very Good</option>

                        <option value="3">★★★☆☆ Good</option>

                        <option value="2">★★☆☆☆ Average</option>

                        <option value="1">★☆☆☆☆ Poor</option>

                    </select>

                </div>

                <div class="mt-6">

                    <label class="font-semibold block mb-3">

                        Your Review

                    </label>

                    <textarea
                        rows="6"
                        name="comment"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500"
                        placeholder="Share your experience..."></textarea>

                </div>

                <button
                    class="mt-8 w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl transition">

                    Submit Feedback

                </button>

            </form>

        </div>

    </div>

</section>

<!-- Customer Reviews -->

<section class="bg-gray-50 py-20">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">

            <h2 class="text-4xl font-bold">

                What Our Customers Say

            </h2>

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            @foreach([1,2,3] as $review)

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="font-bold text-xl">

                            Customer

                        </h3>

                        <p class="text-gray-500 text-sm">

                            Verified Customer

                        </p>

                    </div>

                    <div class="text-yellow-400 text-xl">

                        ★★★★★

                    </div>

                </div>

                <p class="mt-6 text-gray-600 leading-8">

                    Amazing restaurant with delicious food,
                    quick service,
                    clean environment,
                    and friendly staff.
                    Highly recommended for families.

                </p>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- CTA -->

<section class="bg-orange-600 py-20 text-center text-white">

    <div class="max-w-4xl mx-auto px-6">

        <h2 class="text-4xl font-bold">

            Thank You For Choosing Us ❤️

        </h2>

        <p class="mt-6 text-orange-100 text-lg">

            We appreciate every review and continuously strive
            to provide the best dining experience.

        </p>

        <a
            href="{{ route('menu') }}"
            class="inline-block mt-8 bg-white text-orange-600 px-8 py-4 rounded-xl font-bold hover:bg-orange-100 transition">

            Back To Menu

        </a>

    </div>

</section>

@endsection