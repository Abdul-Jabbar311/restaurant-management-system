@extends('frontend.layouts.app')

@section('title', 'Our Menu')

@section('content')

<!-- Hero -->

<section class="bg-linear-to-r from-red-600 to-orange-500 text-white py-16">


<div class="max-w-7xl mx-auto px-6">

    <h1 class="text-5xl font-bold mb-3">
        @editable(
            'menu',
            'page_title',
            'Our Menu'
        )
    </h1>

    <p class="text-lg text-red-100">
        @editable(
            'menu',
            'page_description',
            'Freshly prepared dishes made with premium ingredients.'
        )
    </p>

</div>


</section>

<!-- Search -->

<section class="bg-white shadow">


<div class="max-w-7xl mx-auto px-6 py-6">

    <form method="GET"
          action="{{ route('menu') }}">

        <div class="flex gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search food..."
                class="flex-1 border rounded-lg px-5 py-3 focus:ring-2 focus:ring-red-500 outline-none">

            <button
                class="bg-red-600 hover:bg-red-700 text-white px-8 rounded-lg">

                Search

            </button>

        </div>

    </form>

</div>


</section>

<!-- Categories -->

<section class="py-8 bg-gray-100">


<div class="max-w-7xl mx-auto px-6">

    <div class="flex flex-wrap gap-3">

        <a href="{{ route('menu') }}"
           class="px-5 py-2 rounded-full bg-red-600 text-white">

            All

        </a>

        @foreach($categories as $category)

            <a href="{{ route('category', $category) }}"
               class="px-5 py-2 rounded-full bg-white hover:bg-red-600 hover:text-white shadow transition">

                {{ $category->name }}

            </a>

        @endforeach

    </div>

</div>


</section>

<!-- Menu -->

<section class="py-16">


<div class="max-w-7xl mx-auto px-6">

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

        @forelse($menuItems as $item)

            <div
                class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition duration-300 flex flex-col h-full">

                @if($item->image)

                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        class="w-full h-56 object-cover object-center">

                @else

                    <div
                        class="h-56 bg-gray-200 flex items-center justify-center">

                        <span class="text-gray-500">

                            No Image

                        </span>

                    </div>

                @endif


                <div class="p-5 flex flex-col flex-1">

                    <div class="flex justify-between items-center mb-2">

                        <h3 class="font-bold text-xl h-16">

                            {{ $item->name }}

                        </h3>


                        @if($item->is_available)

                            <span
                                class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">

                                Available

                            </span>

                        @else

                            <span
                                class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">

                                Unavailable

                            </span>

                        @endif

                    </div>


                    <p class="text-gray-600 text-sm h-12 overflow-hidden">

                        {{ Str::limit($item->description, 60) }}

                    </p>


                    <div class="flex justify-between items-center mb-5 mt-4">

                        <span class="text-2xl font-bold text-red-600">

                            Rs. {{ number_format($item->price, 2) }}

                        </span>


                        <span class="text-gray-500">

                            ⏱ {{ $item->preparation_time }} min

                        </span>

                    </div>


                    <div class="flex gap-2 mt-auto">

                        <a href="{{ route('menu.show', $item) }}"
                           class="flex-1 bg-gray-200 text-center py-2 rounded-lg hover:bg-gray-300">

                            View

                        </a>


                        <form action="{{ route('cart.add', $item) }}" method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">

                                Add

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-4 text-center py-16">

                <h2 class="text-2xl font-semibold">

                    No Menu Items Available

                </h2>

            </div>

        @endforelse

    </div>


    <div class="mt-12">

        {{ $menuItems->links() }}

    </div>

</div>

</section>

@endsection
