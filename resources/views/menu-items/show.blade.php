@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Menu Item Details
    </h1>

    <a href="{{ route('menu-items.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">
        ← Back
    </a>

</div>

<div class="bg-white rounded-lg shadow p-6">

    <div class="grid grid-cols-2 gap-8">

        {{-- Image --}}
        <div>

            @if($menuItem->image)

                <img
                    src="{{ asset('storage/' . $menuItem->image) }}"
                    alt="{{ $menuItem->name }}"
                    class="w-full h-80 object-cover rounded-lg">

            @else

                <div class="w-full h-80 bg-gray-200 rounded-lg flex items-center justify-center">
                    No Image
                </div>

            @endif

        </div>


        {{-- Basic Information --}}
        <div>

            <h2 class="text-2xl font-bold mb-5">
                {{ $menuItem->name }}
            </h2>

            <div class="space-y-3">

                <p>
                    <strong>Category:</strong>
                    {{ $menuItem->category->name ?? 'N/A' }}
                </p>

                <p>
                    <strong>Price:</strong>
                    Rs. {{ number_format($menuItem->price, 2) }}
                </p>

                <p>
                    <strong>Preparation Time:</strong>
                    {{ $menuItem->preparation_time }} minutes
                </p>

                <p>
                    <strong>Status:</strong>

                    @if($menuItem->is_available)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            Available
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                            Unavailable
                        </span>

                    @endif

                </p>

                <p>
                    <strong>Featured:</strong>

                    @if($menuItem->is_featured)
                        Yes
                    @else
                        No
                    @endif

                </p>

            </div>

        </div>

    </div>


    {{-- Description --}}

    <div class="mt-8 border-t pt-6">

        <h2 class="text-xl font-bold mb-3">
            Description
        </h2>

        <p class="text-gray-700">

            {{ $menuItem->description ?: 'No description available.' }}

        </p>

    </div>


    {{-- Recipe / Ingredients --}}

    <div class="mt-8 border-t pt-6">

        <h2 class="text-xl font-bold mb-2">
            Recipe / Ingredients
        </h2>

        <p class="text-gray-500 text-sm mb-5">
            Ingredients required to prepare one serving.
        </p>


        @if($menuItem->ingredients->count() > 0)

            <div class="overflow-x-auto">

                <table class="min-w-full border">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="p-3 text-left border">
                                Ingredient
                            </th>

                            <th class="p-3 text-center border">
                                Quantity Required
                            </th>

                            <th class="p-3 text-center border">
                                Unit
                            </th>

                            <th class="p-3 text-center border">
                                Current Stock
                            </th>

                            <th class="p-3 text-center border">
                                Stock Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($menuItem->ingredients as $ingredient)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-3 border font-medium">
                                    {{ $ingredient->name }}
                                </td>

                                <td class="p-3 border text-center">
                                    {{ $ingredient->pivot->quantity }}
                                </td>

                                <td class="p-3 border text-center">
                                    {{ $ingredient->unit }}
                                </td>

                                <td class="p-3 border text-center">
                                    {{ $ingredient->stock_quantity }}
                                </td>

                                <td class="p-3 border text-center">

                                    @if($ingredient->stock_quantity <= $ingredient->minimum_stock)

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Low Stock
                                        </span>

                                    @else

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            In Stock
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="border border-dashed rounded-lg p-6 text-center text-gray-500">

                No ingredients have been added to this menu item.

            </div>

        @endif

    </div>


    {{-- Actions --}}

    <div class="mt-8 border-t pt-6">

        <a
            href="{{ route('menu-items.edit', $menuItem) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

            Edit Menu Item

        </a>

        <a
            href="{{ route('menu-items.index') }}"
            class="ml-3 bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

            Back to Menu

        </a>

    </div>

</div>

@endsection