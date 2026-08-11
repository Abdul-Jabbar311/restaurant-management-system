@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

@if(session('success'))


<div class="max-w-7xl mx-auto px-6 mt-5">

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

        {{ session('success') }}

    </div>

</div>


@endif

@if(session('table_name'))


<div class="max-w-7xl mx-auto px-6 mt-5">

    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">

        🍽 Ordering from:

        <strong>{{ session('table_name') }}</strong>

        ({{ session('table_number') }})

    </div>

</div>


@endif

<!-- HERO SECTION -->

<section class="bg-red-600 text-white">


<div class="max-w-7xl mx-auto px-6 py-24">

    <div class="grid md:grid-cols-2 gap-10 items-center">

        <div>

            <h1 class="text-5xl font-bold leading-tight mb-6">

                @editable(
                    'home',
                    'hero_title',
                    'Delicious Food <br> Delivered Fresh <br> To Your Table'
                )

            </h1>


            <p class="text-lg mb-8 text-red-100">

                @editable(
                    'home',
                    'hero_description',
                    'Order your favourite meals anytime with our smart restaurant system. Fast delivery, fresh ingredients and amazing taste.'
                )

            </p>


            <a href="{{ route('menu') }}"
                class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100">

                @editable('home', 'hero_button', 'Explore Menu')

            </a>

        </div>


        <div>

            <img
                src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900"
                class="rounded-xl shadow-xl w-full">

        </div>

    </div>

</div>


</section>

<!-- CATEGORIES -->

<section class="py-16 bg-white">


<div class="max-w-7xl mx-auto px-6">

    <h2 class="text-3xl font-bold text-center mb-12">

        Browse Categories

    </h2>


    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach($categories as $category)

            <a href="{{ route('category',$category) }}"
                class="bg-gray-100 rounded-xl p-6 text-center hover:bg-red-600 hover:text-white transition">

                @if($category->image)

                    <img
                        src="{{ asset('storage/'.$category->image) }}"
                        class="w-28 h-28 mx-auto rounded-full object-cover mb-4">

                @else

                    <div
                        class="w-28 h-28 mx-auto rounded-full bg-gray-300 mb-4 flex items-center justify-center">

                        🍽

                    </div>

                @endif


                <h3 class="font-semibold text-lg">

                    {{ $category->name }}

                </h3>

            </a>

        @endforeach

    </div>

</div>


</section>

<!-- FEATURED ITEMS -->

<section class="py-20 bg-gray-100">


<div class="max-w-7xl mx-auto px-6">

    <h2 class="text-3xl font-bold text-center mb-12">

        @editable('home', 'featured_title', 'Featured Dishes')

    </h2>


    <div class="grid md:grid-cols-4 gap-8">

        @foreach($featuredItems as $item)

            <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden flex flex-col h-full">

                @if($item->image)

                    <img
                        src="{{ asset('storage/'.$item->image) }}"
                        class="h-52 w-full object-cover">

                @else

                    <div
                        class="h-52 bg-gray-300 flex items-center justify-center text-5xl">

                        🍕

                    </div>

                @endif


                <div class="p-5 flex flex-col flex-1">

                    <h3 class="text-xl font-bold">

                        {{ $item->name }}

                    </h3>


                    <p class="text-gray-500 mt-2 h-16 overflow-hidden">

                        {{ Str::limit($item->description,70) }}

                    </p>


                    <div class="flex justify-between items-center mt-auto pt-4">

                        <span class="text-red-600 text-xl font-bold">

                            Rs. {{ number_format($item->price,2) }}

                        </span>


                        <a href="{{ route('menu.show',$item) }}"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">

                            View

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>


</section>

<!-- SPECIAL OFFER -->

<section class="py-20 bg-orange-600 text-white">


<div class="max-w-7xl mx-auto px-6">

    <div class="grid md:grid-cols-2 gap-10 items-center">

        <div>

            <h2 class="text-5xl font-bold mb-6">

                @editable('home', 'offer_title', "🔥 Today's Special Offer")

            </h2>


            <p class="text-xl text-orange-100 mb-8">

                @editable(
                    'home',
                    'offer_description',
                    'Get 20% OFF on all Pizza and Burgers. Limited time offer for online orders.'
                )

            </p>


            <a href="{{ route('menu') }}"
                class="bg-white text-orange-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100">

                @editable('home', 'offer_button', 'Order Now')

            </a>

        </div>


        <div>

            <img
                src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=900"
                class="rounded-2xl shadow-2xl">

        </div>

    </div>

</div>


</section>

<!-- STATISTICS -->

<section class="py-20 bg-gray-100">


<div class="max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">


        <!-- Happy Customers -->

        <div>

            <h2 class="text-5xl font-bold text-red-600">

                @editable('home', 'stat_customers_number', '1000+')

            </h2>

            <p class="mt-3 text-gray-600">

                @editable('home', 'stat_customers_label', 'Happy Customers')

            </p>

        </div>


        <!-- Menu Items -->

        <div>

            <h2 class="text-5xl font-bold text-red-600">

                @editable('home', 'stat_menu_number', '150+')

            </h2>

            <p class="mt-3 text-gray-600">

                @editable('home', 'stat_menu_label', 'Menu Items')

            </p>

        </div>


        <!-- Expert Chefs -->

        <div>

            <h2 class="text-5xl font-bold text-red-600">

                @editable('home', 'stat_chefs_number', '25+')

            </h2>

            <p class="mt-3 text-gray-600">

                @editable('home', 'stat_chefs_label', 'Expert Chefs')

            </p>

        </div>


        <!-- Customer Rating -->

        <div>

            <h2 class="text-5xl font-bold text-red-600">

                @editable('home', 'stat_rating_number', '4.9★')

            </h2>

            <p class="mt-3 text-gray-600">

                @editable('home', 'stat_rating_label', 'Customer Rating')

            </p>

        </div>


    </div>

</div>


</section>

<!-- TESTIMONIALS -->

<section class="py-20 bg-white">


<div class="max-w-7xl mx-auto px-6">

    <h2 class="text-4xl font-bold text-center mb-14">

        @editable('home', 'testimonials_title', 'What Our Customers Say')

    </h2>


    <div class="grid md:grid-cols-3 gap-8">


        <!-- Testimonial 1 -->

        <div class="bg-gray-100 rounded-2xl p-8">

            <div class="text-yellow-500 text-2xl">

                ★★★★★

            </div>


            <p class="mt-4 text-gray-600">

                @editable(
                    'home',
                    'testimonial_1_text',
                    'Amazing food and excellent service. Highly recommended.'
                )

            </p>


            <h4 class="font-bold mt-6">

                @editable('home', 'testimonial_1_name', 'Ali Khan')

            </h4>

        </div>


        <!-- Testimonial 2 -->

        <div class="bg-gray-100 rounded-2xl p-8">

            <div class="text-yellow-500 text-2xl">

                ★★★★★

            </div>


            <p class="mt-4 text-gray-600">

                @editable(
                    'home',
                    'testimonial_2_text',
                    'Fast delivery and delicious taste. Will definitely order again.'
                )

            </p>


            <h4 class="font-bold mt-6">

                @editable('home', 'testimonial_2_name', 'Sara Ahmed')

            </h4>

        </div>


        <!-- Testimonial 3 -->

        <div class="bg-gray-100 rounded-2xl p-8">

            <div class="text-yellow-500 text-2xl">

                ★★★★★

            </div>


            <p class="mt-4 text-gray-600">

                @editable(
                    'home',
                    'testimonial_3_text',
                    'One of the best restaurants in town. Fresh food every time.'
                )

            </p>


            <h4 class="font-bold mt-6">

                @editable('home', 'testimonial_3_name', 'Usman Ali')

            </h4>

        </div>


    </div>

</div>


</section>

<!-- RESERVATION -->

<section class="py-20 bg-red-600 text-white">


<div class="max-w-6xl mx-auto px-6 text-center">

    <h2 class="text-5xl font-bold mb-6">

        @editable('home', 'reservation_title', 'Reserve Your Table')

    </h2>


    <p class="text-xl text-red-100 mb-8">

        @editable(
            'home',
            'reservation_description',
            'Planning dinner with family or friends? Reserve your table online.'
        )

    </p>


    <a href="{{ route('reservation.front') }}"
        class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100">

        @editable('home', 'reservation_button', 'Book Now')

    </a>

</div>


</section>

<!-- WHY CHOOSE US -->

<section class="py-20 bg-white">


<div class="max-w-7xl mx-auto px-6">

    <h2 class="text-3xl font-bold text-center mb-12">

        @editable('home', 'why_choose_title', 'Why Choose Us')

    </h2>


    <div class="grid md:grid-cols-3 gap-10">


        <!-- Fast Delivery -->

        <div class="text-center">

            <div class="text-6xl mb-5">

                🚚

            </div>


            <h3 class="text-2xl font-bold">

                @editable('home', 'why_delivery_title', 'Fast Delivery')

            </h3>


            <p class="text-gray-500 mt-3">

                @editable(
                    'home',
                    'why_delivery_description',
                    'Fresh food delivered quickly to your doorstep.'
                )

            </p>

        </div>


        <!-- Expert Chefs -->

        <div class="text-center">

            <div class="text-6xl mb-5">

                👨‍🍳

            </div>


            <h3 class="text-2xl font-bold">

                @editable('home', 'why_chefs_title', 'Expert Chefs')

            </h3>


            <p class="text-gray-500 mt-3">

                @editable(
                    'home',
                    'why_chefs_description',
                    'Prepared by experienced chefs using quality ingredients.'
                )

            </p>

        </div>


        <!-- Top Quality -->

        <div class="text-center">

            <div class="text-6xl mb-5">

                ⭐

            </div>


            <h3 class="text-2xl font-bold">

                @editable('home', 'why_quality_title', 'Top Quality')

            </h3>


            <p class="text-gray-500 mt-3">

                @editable(
                    'home',
                    'why_quality_description',
                    'Premium taste with hygienic preparation every day.'
                )

            </p>

        </div>


    </div>

</div>


</section>

<!-- CTA -->

<section class="bg-red-600 py-20 text-center text-white">


<h2 class="text-4xl font-bold mb-6">

    @editable('home', 'cta_title', 'Ready To Order?')

</h2>


<p class="text-xl mb-8">

    @editable(
        'home',
        'cta_description',
        'Browse our delicious menu and enjoy your meal.'
    )

</p>


<a href="{{ route('menu') }}"
    class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100">

    @editable('home', 'cta_button', 'Order Now')

</a>


</section>

@endsection
