<!DOCTYPE html>
<html lang="en">


<style>

@keyframes fadeIn {

    from{
        opacity:0;
        transform:translateY(40px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

.animate-fade{

    animation:fadeIn .8s ease;

}

</style>

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

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



</body>


</html>