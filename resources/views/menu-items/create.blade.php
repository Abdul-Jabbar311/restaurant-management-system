@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================= HEADER ================= -->

    <div class="mb-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Add Menu Item
                </h1>

                <p class="text-gray-500 mt-2">
                    Create a new menu item and define the ingredients required to prepare it.
                </p>

            </div>

            <a
                href="{{ route('menu-items.index') }}"
                class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-3 rounded-xl font-medium transition">

                ← Back to Menu

            </a>

        </div>

    </div>


    <!-- ================= ERRORS ================= -->

    @if ($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">

            <div class="font-bold mb-2">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside space-y-1">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- ================= MAIN FORM ================= -->

    <form
        action="{{ route('menu-items.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf


        <!-- ================= MENU INFORMATION ================= -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">

            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-xl">
                        🍽️
                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-gray-800">
                            Menu Information
                        </h2>

                        <p class="text-sm text-gray-500">
                            Enter the basic information about this food item.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    <!-- Category -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none">

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Menu Name -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Menu Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Chicken Biryani"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none">

                    </div>


                    <!-- Price -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Price
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                Rs.
                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="850"
                                class="w-full border border-gray-300 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none">

                        </div>

                    </div>


                    <!-- Preparation Time -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Preparation Time
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                min="1"
                                name="preparation_time"
                                value="{{ old('preparation_time') }}"
                                placeholder="25"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 pr-24 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none">

                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                                minutes
                            </span>

                        </div>

                    </div>

                </div>


                <!-- Description -->

                <div class="mt-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Describe this menu item..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none">{{ old('description') }}</textarea>

                </div>


                <!-- Image -->

                <div class="mt-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Food Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white focus:ring-2 focus:ring-orange-500 focus:outline-none">

                    <p class="text-xs text-gray-500 mt-2">
                        JPG, JPEG or PNG. Maximum size: 2MB.
                    </p>

                </div>

            </div>

        </div>


        <!-- ================= RECIPE ================= -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">

            <!-- Recipe Header -->

            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-xl">
                            🧂
                        </div>

                        <div>

                            <h2 class="text-xl font-bold text-gray-800">
                                Recipe / Ingredients
                            </h2>

                            <p class="text-sm text-gray-500">
                                Define the ingredients required for one serving.
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        onclick="addIngredient()"
                        class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-semibold transition shadow-sm">

                        <span class="text-lg">
                            +
                        </span>

                        Add Ingredient

                    </button>

                </div>

            </div>


            <!-- Recipe Body -->

            <div class="p-6">


                <!-- Information -->

                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-xl p-4">

                    <div class="flex gap-3">

                        <div class="text-blue-600 text-lg">
                            ℹ️
                        </div>

                        <div>

                            <p class="font-semibold text-blue-800">
                                How recipe quantities work
                            </p>

                            <p class="text-sm text-blue-700 mt-1">
                                Enter the amount of each ingredient needed to prepare
                                <strong>ONE serving</strong> of this menu item.
                            </p>

                            <p class="text-sm text-blue-700 mt-1">
                                Example: Chicken Biryani may require 0.250 Kg Chicken,
                                0.200 Kg Rice and 0.020 Kg Masala.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Ingredient Table Header -->

                <div
                    id="ingredients-header"
                    class="hidden md:grid grid-cols-12 gap-4 px-4 mb-2 text-sm font-semibold text-gray-600">

                    <div class="col-span-6">
                        Ingredient
                    </div>

                    <div class="col-span-4">
                        Quantity Required
                    </div>

                    <div class="col-span-2">
                        Action
                    </div>

                </div>


                <!-- Ingredients -->

                <div id="ingredients-container">

                    <!-- Dynamic ingredient rows -->

                </div>


                <!-- Empty State -->

                <div
                    id="no-ingredients"
                    class="border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center">

                    <div class="text-5xl mb-4">
                        🧂
                    </div>

                    <h3 class="text-lg font-bold text-gray-700">
                        No Ingredients Added
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Add the ingredients required to prepare this menu item.
                    </p>

                    <button
                        type="button"
                        onclick="addIngredient()"
                        class="mt-5 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-semibold transition">

                        + Add First Ingredient

                    </button>

                </div>


                <!-- Recipe Summary -->

                <div
                    id="recipe-summary"
                    class="hidden mt-6 bg-gray-50 border border-gray-200 rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Recipe Ingredients
                            </p>

                            <p
                                id="ingredient-count"
                                class="text-lg font-bold text-gray-800">
                                0 ingredients
                            </p>

                        </div>

                        <div class="text-3xl">
                            👨‍🍳
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= ACTIONS ================= -->

        <div class="flex flex-col sm:flex-row justify-end gap-3 pb-10">

            <a
                href="{{ route('menu-items.index') }}"
                class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-7 py-3 rounded-xl font-semibold transition">

                Cancel

            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-xl font-semibold transition shadow-sm">

                <span>
                    💾
                </span>

                Save Menu Item

            </button>

        </div>

    </form>

</div>


<!-- ================= JAVASCRIPT ================= -->

<script>

let ingredientIndex = 0;

const ingredients = @json($ingredients);


/*
|--------------------------------------------------------------------------
| Add Ingredient
|--------------------------------------------------------------------------
*/

function addIngredient()
{
    const container =
        document.getElementById('ingredients-container');

    const noIngredients =
        document.getElementById('no-ingredients');

    const header =
        document.getElementById('ingredients-header');

    const summary =
        document.getElementById('recipe-summary');


    /*
    |--------------------------------------------------------------------------
    | Hide empty state
    |--------------------------------------------------------------------------
    */

    noIngredients.style.display = 'none';

    header.classList.remove('hidden');

    summary.classList.remove('hidden');


    /*
    |--------------------------------------------------------------------------
    | Create ingredient row
    |--------------------------------------------------------------------------
    */

    const row = document.createElement('div');

    row.className =
        'ingredient-row grid grid-cols-1 md:grid-cols-12 gap-4 items-end bg-gray-50 hover:bg-gray-100 p-5 rounded-xl mb-4 border border-gray-200 transition';


    /*
    |--------------------------------------------------------------------------
    | Ingredient options
    |--------------------------------------------------------------------------
    */

    let options = '';

    ingredients.forEach(function(ingredient) {

        options += `
            <option value="${ingredient.id}">
                ${escapeHtml(ingredient.name)}
                (${escapeHtml(ingredient.unit)})
            </option>
        `;

    });


    /*
    |--------------------------------------------------------------------------
    | Row HTML
    |--------------------------------------------------------------------------
    */

    row.innerHTML = `

        <div class="md:col-span-6">

            <label class="block md:hidden text-sm font-semibold text-gray-700 mb-2">
                Ingredient
            </label>

            <select
                name="ingredients[${ingredientIndex}][id]"
                required
                class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none">

                <option value="">
                    Select Ingredient
                </option>

                ${options}

            </select>

        </div>


        <div class="md:col-span-4">

            <label class="block md:hidden text-sm font-semibold text-gray-700 mb-2">
                Quantity Required
            </label>

            <div class="relative">

                <input
                    type="number"
                    step="0.001"
                    min="0.001"
                    required
                    name="ingredients[${ingredientIndex}][quantity]"
                    placeholder="e.g. 0.250"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 pr-16 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none">

            </div>

        </div>


        <div class="md:col-span-2">

            <button
                type="button"
                onclick="removeIngredient(this)"
                class="w-full bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-3 rounded-xl font-semibold transition">

                🗑 Remove

            </button>

        </div>

    `;


    container.appendChild(row);

    ingredientIndex++;

    updateIngredientCount();
}


/*
|--------------------------------------------------------------------------
| Remove Ingredient
|--------------------------------------------------------------------------
*/

function removeIngredient(button)
{
    const row =
        button.closest('.ingredient-row');

    if (row) {

        row.remove();

    }


    const container =
        document.getElementById('ingredients-container');

    const noIngredients =
        document.getElementById('no-ingredients');

    const header =
        document.getElementById('ingredients-header');

    const summary =
        document.getElementById('recipe-summary');


    /*
    |--------------------------------------------------------------------------
    | Show empty state if no ingredients remain
    |--------------------------------------------------------------------------
    */

    if (container.children.length === 0) {

        noIngredients.style.display = 'block';

        header.classList.add('hidden');

        summary.classList.add('hidden');

    }


    updateIngredientCount();
}


/*
|--------------------------------------------------------------------------
| Update Ingredient Count
|--------------------------------------------------------------------------
*/

function updateIngredientCount()
{
    const container =
        document.getElementById('ingredients-container');

    const count =
        container.children.length;

    const countElement =
        document.getElementById('ingredient-count');


    if (count === 1) {

        countElement.innerText =
            '1 ingredient';

    } else {

        countElement.innerText =
            count + ' ingredients';

    }
}


/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
*/

function escapeHtml(text)
{
    const div =
        document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}

</script>

@endsection