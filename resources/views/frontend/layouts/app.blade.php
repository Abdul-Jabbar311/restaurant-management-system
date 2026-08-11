<!DOCTYPE html>

<html lang="en">

<style>

@keyframes fadeIn {

    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}

.animate-fade {
    animation: fadeIn .8s ease;
}

</style>

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>@yield('title','Restaurant Management')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="bg-gray-100">


<!-- ================= NAVBAR ================= -->

<nav class="bg-white shadow sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">


            <!-- Logo -->

            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-red-600">

                🍽 FoodHub

            </a>


            <!-- Desktop Menu -->

            <div class="hidden md:flex items-center gap-8">

                <a href="{{ route('home') }}"
                   class="hover:text-red-600 font-medium">

                    Home

                </a>


                <a href="{{ route('menu') }}"
                   class="hover:text-red-600 font-medium">

                    Menu

                </a>


                <a href="{{ route('reservation.front') }}"
                   class="hover:text-red-600 font-medium">

                    Reservation

                </a>


                <a href="{{ route('my.orders') }}"
                   class="hover:text-red-600 font-medium">

                    My Orders

                </a>


                <a href="{{ route('about') }}"
                   class="hover:text-red-600 font-medium">

                    About

                </a>


                <a href="{{ route('contact') }}"
                   class="hover:text-red-600 font-medium">

                    Contact

                </a>

            </div>


            <!-- Right Side -->

            <div class="flex items-center gap-4">

                <a href="{{ route('cart') }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                    🛒 Cart

                </a>

            </div>

        </div>

    </div>

</nav>


<!-- ================= PAGE CONTENT ================= -->

<div class="min-h-screen">

    @yield('content')

</div>


<!-- ================= FOOTER ================= -->

<footer class="bg-gray-900 text-white mt-20">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid md:grid-cols-3 gap-10">


            <div>

                <h2 class="text-2xl font-bold mb-4">

                    🍽 FoodHub

                </h2>


                <p class="text-gray-400">

                    Enjoy delicious meals with fast service and easy online ordering.

                </p>

            </div>


            <div>

                <h2 class="text-xl font-semibold mb-4">

                    Quick Links

                </h2>


                <ul class="space-y-2">

                    <li>

                        <a href="{{ route('home') }}"
                           class="hover:text-red-400">

                            Home

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('menu') }}"
                           class="hover:text-red-400">

                            Menu

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('reservation.front') }}"
                           class="hover:text-red-400">

                            Reservation

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('my.orders') }}"
                           class="hover:text-red-400">

                            My Orders

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('contact') }}"
                           class="hover:text-red-400">

                            Contact

                        </a>

                    </li>

                </ul>

            </div>


            <div>

                <h2 class="text-xl font-semibold mb-4">

                    Contact

                </h2>


                <p class="text-gray-400">

                    📍 Islamabad, Pakistan

                </p>


                <p class="text-gray-400">

                    📞 +92 300 1234567

                </p>


                <p class="text-gray-400">

                    ✉ info@foodhub.com

                </p>

            </div>

        </div>


        <hr class="border-gray-700 my-8">


        <p class="text-center text-gray-500">

            © {{ date('Y') }} FoodHub. All Rights Reserved.

        </p>

    </div>

</footer>


{{-- ========================================================= --}}
{{-- FRONTEND EDITOR - ADMIN ONLY --}}
{{-- ========================================================= --}}

@if(Auth::check() && Auth::user()->role?->name === 'Admin')


<div id="editableModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-999999">


    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">


        {{-- Header --}}

        <div class="flex justify-between items-center px-6 py-4 border-b">


            <h2 class="text-xl font-bold text-gray-800">

                Edit Content

            </h2>


            <button
                type="button"
                onclick="closeEditableContent()"
                class="text-gray-500 hover:text-red-600 text-2xl">

                &times;

            </button>

        </div>


        {{-- Body --}}

        <div class="p-6">


            <label class="block font-semibold text-gray-700 mb-2">

                Content

            </label>


            <textarea
                id="editableText"
                rows="6"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>


            <p id="editableError"
               class="hidden text-red-600 text-sm mt-2">

            </p>

        </div>


        {{-- Footer --}}

        <div class="flex justify-end gap-3 px-6 py-4 border-t">


            <button
                type="button"
                onclick="closeEditableContent()"
                class="px-5 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">

                Cancel

            </button>


            <button
                type="button"
                onclick="saveEditableContent()"
                id="editableSaveButton"
                class="px-5 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg">

                Save

            </button>

        </div>

    </div>

</div>


<script>

let editablePage = null;
let editableKey = null;


/*
|--------------------------------------------------------------------------
| Open Editor
|--------------------------------------------------------------------------
*/

function openEditableContent(page, key, text)
{
    editablePage = page;
    editableKey = key;

    document.getElementById('editableText').value = text;

    document.getElementById('editableError').classList.add('hidden');

    const modal = document.getElementById('editableModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Close Editor
|--------------------------------------------------------------------------
*/

function closeEditableContent()
{
    const modal = document.getElementById('editableModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

    editablePage = null;
    editableKey = null;
}


/*
|--------------------------------------------------------------------------
| Save Content
|--------------------------------------------------------------------------
*/

async function saveEditableContent()
{
    const text = document.getElementById('editableText').value;

    const saveButton = document.getElementById('editableSaveButton');

    const error = document.getElementById('editableError');


    if (!editablePage || !editableKey) {
        return;
    }


    saveButton.disabled = true;
    saveButton.innerText = 'Saving...';

    error.classList.add('hidden');


    try {

        const response = await fetch(
            `/editable-content/${encodeURIComponent(editablePage)}/${encodeURIComponent(editableKey)}`,
            {
                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content'),

                    'Accept': 'application/json'

                },

                body: JSON.stringify({

                    content: text

                })

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Read server response safely
        |--------------------------------------------------------------------------
        */

        const responseText = await response.text();

        let data;


        try {

            data = JSON.parse(responseText);

        }

        catch (jsonError) {

            console.error(
                'Server returned non-JSON response:',
                responseText
            );


            throw new Error(
                'Server returned an HTML page instead of JSON. ' +
                'Please check your Laravel controller or login session.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Handle Laravel errors
        |--------------------------------------------------------------------------
        */

        if (!response.ok) {

            throw new Error(
                data.message ||
                'Unable to save content.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Successfully saved
        |--------------------------------------------------------------------------
        */

        closeEditableContent();


        // Reload page so updated database content appears

        window.location.reload();

    }


    catch (errorMessage) {

        console.error(
            'Editable content error:',
            errorMessage
        );


        error.innerText = errorMessage.message;

        error.classList.remove('hidden');

    }


    finally {

        saveButton.disabled = false;

        saveButton.innerText = 'Save';

    }

}


/*
|--------------------------------------------------------------------------
| Close modal when clicking outside
|--------------------------------------------------------------------------
*/

document
    .getElementById('editableModal')
    ?.addEventListener(
        'click',
        function(event)
        {

            if (event.target === this) {

                closeEditableContent();

            }

        }
    );

</script>


@endif


</body>

</html>

