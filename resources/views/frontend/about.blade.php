@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

<!-- Hero -->

<section class="relative bg-orange-600 text-white py-24 overflow-hidden">


<div class="absolute inset-0 bg-black/20"></div>

<div class="relative max-w-7xl mx-auto px-6">

    <div class="grid lg:grid-cols-2 gap-16 items-center">

        <div>

            <span class="uppercase tracking-[6px] text-orange-200 font-semibold">
                @editable('about', 'hero_label', 'Welcome To Our Restaurant')
            </span>

            <h1 class="text-5xl lg:text-6xl font-extrabold mt-6 leading-tight">

                @editable('about', 'hero_title', 'Delicious Food, Memorable Moments')

            </h1>

            <p class="mt-8 text-lg text-orange-100 leading-8">

                @editable(
                    'about',
                    'hero_description',
                    "We believe food is more than a meal. It's an experience. Every dish is freshly prepared using premium ingredients, served with love and hospitality."
                )

            </p>

            <div class="mt-10 flex gap-4">

                <a href="{{ route('menu') }}"
                   class="bg-white text-orange-600 px-8 py-4 rounded-xl font-semibold hover:bg-orange-100 transition">

                    Explore Menu

                </a>

                <a href="{{ route('reservation.front') }}"
                   class="border border-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-orange-600 transition">

                    Reserve Table

                </a>

            </div>

        </div>

        <div>

            <img
                src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900"
                class="rounded-3xl shadow-2xl w-full"
                alt="Restaurant">

        </div>

    </div>

</div>


</section>

<!-- Story -->

<section class="py-24 bg-white">


<div class="max-w-7xl mx-auto px-6">

    <div class="grid lg:grid-cols-2 gap-16 items-center">

        <img
            src="https://images.unsplash.com/photo-1552566626-52f8b828add9?w=900"
            class="rounded-3xl shadow-lg">

        <div>

            <span class="text-orange-600 uppercase font-bold tracking-[4px]">

                @editable('about', 'story_label', 'Our Story')

            </span>

            <h2 class="text-4xl font-bold mt-5">

                @editable('about', 'story_title', 'Passion For Great Food')

            </h2>

            <p class="mt-6 text-gray-600 leading-8">

                @editable(
                    'about',
                    'story_paragraph_1',
                    'Since our beginning, we have served thousands of customers with freshly prepared meals, premium quality ingredients, exceptional customer service, and a comfortable dining experience.'
                )

            </p>

            <p class="mt-5 text-gray-600 leading-8">

                @editable(
                    'about',
                    'story_paragraph_2',
                    "Whether you're visiting with family, celebrating with friends, or ordering online, our mission is to provide unforgettable food every single time."
                )

            </p>

        </div>

    </div>

</div>


</section>

<!-- Why Choose -->

<section class="bg-gray-50 py-24">


<div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">

        <span class="text-orange-600 uppercase font-bold tracking-[4px]">

            @editable('about', 'why_label', 'Why Choose Us')

        </span>

        <h2 class="text-4xl font-bold mt-4">

            @editable('about', 'why_title', 'Experience The Difference')

        </h2>

    </div>


    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8">


        <!-- Fresh Food -->

        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <div class="text-6xl mb-5">

                🍔

            </div>

            <h3 class="text-xl font-bold">

                @editable('about', 'feature_1_title', 'Fresh Food')

            </h3>

            <p class="text-gray-600 mt-4">

                @editable(
                    'about',
                    'feature_1_description',
                    'Prepared daily using fresh ingredients.'
                )

            </p>

        </div>


        <!-- Expert Chefs -->

        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <div class="text-6xl mb-5">

                👨‍🍳

            </div>

            <h3 class="text-xl font-bold">

                @editable('about', 'feature_2_title', 'Expert Chefs')

            </h3>

            <p class="text-gray-600 mt-4">

                @editable(
                    'about',
                    'feature_2_description',
                    'Professional chefs with years of experience.'
                )

            </p>

        </div>


        <!-- Fast Delivery -->

        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <div class="text-6xl mb-5">

                🚀

            </div>

            <h3 class="text-xl font-bold">

                @editable('about', 'feature_3_title', 'Fast Delivery')

            </h3>

            <p class="text-gray-600 mt-4">

                @editable(
                    'about',
                    'feature_3_description',
                    'Hot and fresh food delivered quickly.'
                )

            </p>

        </div>


        <!-- Best Service -->

        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <div class="text-6xl mb-5">

                ❤️

            </div>

            <h3 class="text-xl font-bold">

                @editable('about', 'feature_4_title', 'Best Service')

            </h3>

            <p class="text-gray-600 mt-4">

                @editable(
                    'about',
                    'feature_4_description',
                    'Customer satisfaction is always our priority.'
                )

            </p>

        </div>


    </div>

</div>


</section>

<!-- Statistics -->

<section class="bg-orange-600 py-20 text-white">


<div class="max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">

        <div>

            <h2 class="text-5xl font-extrabold">

                15+

            </h2>

            <p class="mt-3 text-orange-100">

                Years Experience

            </p>

        </div>


        <div>

            <h2 class="text-5xl font-extrabold">

                25K+

            </h2>

            <p class="mt-3 text-orange-100">

                Happy Customers

            </p>

        </div>


        <div>

            <h2 class="text-5xl font-extrabold">

                300+

            </h2>

            <p class="mt-3 text-orange-100">

                Menu Items

            </p>

        </div>


        <div>

            <h2 class="text-5xl font-extrabold">

                50K+

            </h2>

            <p class="mt-3 text-orange-100">

                Orders Delivered

            </p>

        </div>

    </div>

</div>


</section>

<!-- Team -->

<section class="py-24 bg-white">


<div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">

        <span class="text-orange-600 uppercase font-bold">

            @editable('about', 'team_label', 'Our Team')

        </span>

        <h2 class="text-4xl font-bold mt-4">

            @editable('about', 'team_title', 'Meet Our Chefs')

        </h2>

    </div>


    <div class="grid md:grid-cols-3 gap-10">

        @foreach([
            'Chef Alex',
            'Chef Emma',
            'Chef Daniel'
        ] as $chef)

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden text-center">

                <img
                    src="https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?w=600"
                    class="w-full h-80 object-cover"
                    alt="{{ $chef }}">

                <div class="p-6">

                    <h3 class="text-2xl font-bold">

                        {{ $chef }}

                    </h3>

                    <p class="text-orange-600 mt-2">

                        @editable('about', 'chef_role', 'Master Chef')

                    </p>

                </div>

            </div>

        @endforeach

    </div>

</div>


</section>

<!-- Testimonials -->

<section class="bg-gray-50 py-24">


<div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">

        <h2 class="text-4xl font-bold">

            @editable('about', 'testimonial_title', 'What Customers Say')

        </h2>

    </div>


    <div class="grid lg:grid-cols-3 gap-8">

        @foreach([1, 2, 3] as $review)

            <div class="bg-white p-8 rounded-3xl shadow-lg">

                <div class="text-yellow-400 text-2xl">

                    ★★★★★

                </div>

                <p class="mt-5 text-gray-600 leading-8">

                    @editable(
                        'about',
                        'testimonial_text',
                        'Amazing food, excellent service, beautiful environment, and very quick delivery. Highly recommended.'
                    )

                </p>

                <div class="mt-6">

                    <h4 class="font-bold">

                        Happy Customer

                    </h4>

                </div>

            </div>

        @endforeach

    </div>

</div>
```

</section>

<!-- Gallery -->

<section class="py-24 bg-white">

```
<div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">

        <h2 class="text-4xl font-bold">

            @editable('about', 'gallery_title', 'Restaurant Gallery')

        </h2>

    </div>


    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach([

            'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=600',

            'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=600',

            'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600',

            'https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?w=600'

        ] as $image)

            <img
                src="{{ $image }}"
                class="rounded-2xl h-72 w-full object-cover hover:scale-105 transition duration-300 shadow-lg"
                alt="Restaurant Gallery Image">

        @endforeach

    </div>

</div>
```

</section>

@endsection
