@extends('frontend.layouts.app')

@section('title', $category->name)

@section('content')

<!-- Hero -->

<section class="bg-orange-600 py-20 text-white">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h1 class="text-5xl font-extrabold">

            {{ $category->name }}

        </h1>

        <p class="mt-5 text-xl text-orange-100">

            Browse all delicious {{ strtolower($category->name) }} available in our restaurant.

        </p>

    </div>

</section>

<!-- Breadcrumb -->

<section class="bg-gray-100 py-4">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-sm text-gray-600">

            <a href="{{ route('home') }}" class="hover:text-orange-600">

                Home

            </a>

            /

            <a href="{{ route('menu') }}" class="hover:text-orange-600">

                Menu

            </a>

            /

            <span class="text-orange-600 font-semibold">

                {{ $category->name }}

            </span>

        </div>

    </div>

</section>

<!-- Menu Items -->

<section class="py-20 bg-gray-50">

    <div class="max-w-7xl mx-auto px-6">

        @if($menuItems->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            @foreach($menuItems as $item)

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                @if($item->image)

                    <img
                        src="{{ asset('storage/'.$item->image) }}"
                        class="w-full h-64 object-cover">

                @else

                    <div class="h-64 bg-gray-200 flex items-center justify-center text-gray-500">

                        No Image

                    </div>

                @endif

                <div class="p-6">

                    <div class="flex justify-between items-center">

                        <h2 class="text-2xl font-bold">

                            {{ $item->name }}

                        </h2>

                        <span class="text-orange-600 font-bold">

                            Rs {{ number_format($item->price,0) }}

                        </span>

                    </div>

                    <p class="text-gray-500 mt-4 line-clamp-3">

                        {{ $item->description }}

                    </p>

                    <div class="flex justify-between items-center mt-6">

                        <span class="text-sm text-gray-500">

                            ⏱ {{ $item->preparation_time }} mins

                        </span>

                        @if($item->is_available)

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Available

                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Out of Stock

                            </span>

                        @endif

                    </div>
                                        <div class="mt-6 flex gap-3">

                        <a
                            href="{{ route('menu.show', $item) }}"
                            class="flex-1 bg-orange-600 hover:bg-orange-700 text-white text-center py-3 rounded-xl font-semibold">

                            View

                        </a>

                        <form
                            action="{{ route('cart.add', $item) }}"
                            method="POST"
                            class="flex-1">

                            @csrf

                            <button
                                type="submit"
                                class="w-full border border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white py-3 rounded-xl font-semibold">

                                Add Cart

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="mt-12">

            {{ $menuItems->links() }}

        </div>

        @else

        <div class="bg-white rounded-3xl shadow-lg p-16 text-center">

            <h2 class="text-4xl font-bold text-gray-700">

                No Menu Items Found

            </h2>

            <p class="text-gray-500 mt-5">

                This category doesn't have any available menu items.

            </p>

            <a
                href="{{ route('menu') }}"
                class="inline-block mt-8 bg-orange-600 hover:bg-orange-700 text-white px-8 py-4 rounded-xl">

                Browse Full Menu

            </a>

        </div>

        @endif

    </div>

</section>
@endsection