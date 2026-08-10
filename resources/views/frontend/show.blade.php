@extends('frontend.layouts.app')

@section('title', $menuItem->name)

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12">

    <a href="{{ route('menu') }}"
       class="inline-flex items-center text-orange-600 hover:text-orange-700 font-semibold mb-8">
        ← Back to Menu
    </a>

    <div class="grid lg:grid-cols-2 gap-12">

        <!-- Image -->
        <div>

            @if($menuItem->image)

               <img src="{{ asset('storage/'.$menuItem->image) }}"
     class="w-full h-80 object-cover rounded-3xl shadow-xl">

            @else

               <div class="w-full h-80 bg-gray-200 rounded-3xl flex items-center justify-center">

                    <span class="text-6xl">🍽️</span>

                </div>

            @endif

        </div>

        <!-- Details -->
        <div>

            <span class="inline-block bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm mb-4">

                {{ $menuItem->category->name }}

            </span>

            <h1 class="text-5xl font-bold text-gray-800 mb-4">

                {{ $menuItem->name }}

            </h1>

            <p class="text-4xl font-bold text-orange-600 mb-6">

                Rs. {{ number_format($menuItem->price,2) }}

            </p>

            <div class="flex flex-wrap gap-4 mb-6">

                <div class="bg-gray-100 px-5 py-3 rounded-xl">

                    ⏱ {{ $menuItem->preparation_time }} Minutes

                </div>

                <div>

                    @if($menuItem->is_available)

                        <span class="bg-green-100 text-green-700 px-5 py-3 rounded-xl">

                            ✅ Available

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-5 py-3 rounded-xl">

                            ❌ Out of Stock

                        </span>

                    @endif

                </div>

            </div>

            <p class="text-gray-600 leading-8 text-lg mb-8">

                {{ $menuItem->description }}

            </p>

            @if($menuItem->is_available)

           <form action="{{ route('cart.add', $menuItem) }}" method="POST">

                @csrf

                <div class="flex items-center gap-5 mb-8">

                    <label class="font-semibold text-lg">

                        Quantity

                    </label>

                    <input type="number"
                           name="quantity"
                           value="1"
                           min="1"
                           class="border rounded-xl w-24 px-4 py-3">

                </div>

                <button
    type="submit"
    class="bg-orange-600 hover:bg-orange-700 text-white px-10 py-4 rounded-xl font-semibold transition">
                    🛒 Add To Cart

                </button>

            </form>

            @endif

        </div>

    </div>

    <!-- Related Items -->

    @php

        $relatedItems = \App\Models\MenuItem::where('category_id',$menuItem->category_id)
                            ->where('id','!=',$menuItem->id)
                            ->where('is_available',true)
                            ->take(4)
                            ->get();

    @endphp

    @if($relatedItems->count())

    <div class="mt-20">

        <h2 class="text-3xl font-bold mb-8">

            Related Dishes

        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach($relatedItems as $item)

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

                @if($item->image)

                    <img src="{{ asset('storage/'.$item->image) }}"
                         class="w-full h-52 object-cover">

                @else

                    <div class="w-full h-52 bg-gray-200 flex items-center justify-center">

                        🍔

                    </div>

                @endif

                <div class="p-5">

                    <h3 class="font-bold text-xl mb-2">

                        {{ $item->name }}

                    </h3>

                    <p class="text-orange-600 font-bold text-lg mb-4">

                        Rs. {{ number_format($item->price,2) }}

                    </p>

                    <a href="{{ route('menu.show', $item) }}"
                       class="block text-center bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-xl">

                        View Details

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

    @endif

</div>

@endsection