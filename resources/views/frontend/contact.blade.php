@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')

<section class="bg-linear-to-r from-orange-50 to-white py-16">


<div class="max-w-7xl mx-auto px-6">

    <!-- Heading -->

    <div class="text-center mb-14">

        <span class="text-orange-600 font-semibold uppercase tracking-widest">

            @editable('contact', 'hero_label', 'Contact Us')

        </span>

        <h1 class="text-5xl font-extrabold text-gray-900 mt-3">

            @editable('contact', 'hero_title', "We'd Love To Hear From You")

        </h1>

        <p class="text-gray-600 max-w-2xl mx-auto mt-5 text-lg">

            @editable(
                'contact',
                'hero_description',
                'Whether you have a question about our menu, reservations, catering, or your order, our team is ready to help.'
            )

        </p>

    </div>


    <div class="grid lg:grid-cols-2 gap-12">


        <!-- Contact Form -->

        <div class="bg-white rounded-3xl shadow-xl p-8">

            <h2 class="text-2xl font-bold text-gray-800 mb-8">

                @editable('contact', 'form_title', 'Send us a Message')

            </h2>


            @if(session('success'))

                <div class="mb-5 bg-green-100 text-green-700 p-4 rounded-lg">

                    {{ session('success') }}

                </div>

            @endif


            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">

                @csrf


                <div>

                    <label class="block mb-2 font-semibold text-gray-700">

                        Full Name

                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="John Doe"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">

                </div>


                <div>

                    <label class="block mb-2 font-semibold text-gray-700">

                        Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="example@email.com"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">

                </div>


                <div>

                    <label class="block mb-2 font-semibold text-gray-700">

                        Phone Number

                    </label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="+92 300 1234567"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">

                </div>


                <div>

                    <label class="block mb-2 font-semibold text-gray-700">

                        Subject

                    </label>

                    <input
                        type="text"
                        name="subject"
                        placeholder="Reservation / Complaint / Inquiry"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">

                </div>


                <div>

                    <label class="block mb-2 font-semibold text-gray-700">

                        Message

                    </label>

                    <textarea
                        rows="6"
                        name="message"
                        placeholder="Write your message..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>

                </div>


                <button
                    class="w-full bg-orange-600 hover:bg-orange-700 transition text-white font-semibold py-4 rounded-xl">

                    Send Message

                </button>

            </form>

        </div>


        <!-- Contact Information -->

        <div class="space-y-8">


            <div class="bg-white rounded-3xl shadow-xl p-8">

                <h2 class="text-2xl font-bold mb-8">

                    @editable('contact', 'info_title', 'Restaurant Information')

                </h2>


                <div class="space-y-7">


                    <!-- Address -->

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-2xl">

                            📍

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                @editable('contact', 'address_label', 'Address')

                            </h4>

                            <p class="text-gray-600 mt-1">

                                @editable(
                                    'contact',
                                    'address',
                                    'Main Food Street, Blue Area, Islamabad, Pakistan'
                                )

                            </p>

                        </div>

                    </div>


                    <!-- Phone -->

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-2xl">

                            📞

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                @editable('contact', 'phone_label', 'Phone')

                            </h4>

                            <p class="text-gray-600 mt-1">

                                @editable('contact', 'phone', '+92 300 1234567')

                            </p>

                        </div>

                    </div>


                    <!-- Email -->

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-2xl">

                            ✉️

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                @editable('contact', 'email_label', 'Email')

                            </h4>

                            <p class="text-gray-600 mt-1">

                                @editable('contact', 'email', 'restaurant@example.com')

                            </p>

                        </div>

                    </div>


                    <!-- Opening Hours -->

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-2xl">

                            🕒

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                @editable('contact', 'hours_label', 'Opening Hours')

                            </h4>

                            <p class="text-gray-600 mt-1">

                                @editable('contact', 'days', 'Monday - Sunday')

                            </p>

                            <p class="text-gray-600">

                                @editable('contact', 'hours', '10:00 AM - 11:00 PM')

                            </p>

                        </div>

                    </div>


                </div>

            </div>


            <!-- Google Map -->

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <iframe
                    src="https://maps.google.com/maps?q=Islamabad&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="350"
                    style="border:0;"
                    loading="lazy">

                </iframe>

            </div>


            <!-- Social -->

            <div class="bg-white rounded-3xl shadow-xl p-8">

                <h2 class="text-2xl font-bold mb-6">

                    @editable('contact', 'social_title', 'Follow Us')

                </h2>

                <div class="flex gap-5">

                    <a href="#"
                       class="w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl hover:scale-110 transition">

                        f

                    </a>

                    <a href="#"
                       class="w-14 h-14 rounded-full bg-pink-600 text-white flex items-center justify-center text-xl hover:scale-110 transition">

                        ◎

                    </a>

                    <a href="#"
                       class="w-14 h-14 rounded-full bg-sky-500 text-white flex items-center justify-center text-xl hover:scale-110 transition">

                        𝕏

                    </a>

                    <a href="#"
                       class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center text-xl hover:scale-110 transition">

                        ▶

                    </a>

                </div>

            </div>


        </div>

    </div>

</div>


</section>

@endsection
