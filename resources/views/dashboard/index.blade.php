@extends('layouts.app')

@section('content')

{{-- Google Fonts for premium typography — safe to remove if you already load fonts in layouts.app --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .rd-font-display { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
    .rd-font-body { font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; }

    /* ---------- Entrance animations ---------- */
    @keyframes rdFadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes rdFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    @keyframes rdFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50%      { transform: translateY(-10px) rotate(3deg); }
    }
    @keyframes rdShimmer {
        0%   { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .rd-animate {
        opacity: 0;
        animation: rdFadeUp 0.6s ease-out forwards;
    }
    .rd-delay-1 { animation-delay: .05s; }
    .rd-delay-2 { animation-delay: .1s; }
    .rd-delay-3 { animation-delay: .15s; }
    .rd-delay-4 { animation-delay: .2s; }
    .rd-delay-5 { animation-delay: .25s; }
    .rd-delay-6 { animation-delay: .3s; }
    .rd-delay-7 { animation-delay: .35s; }
    .rd-delay-8 { animation-delay: .4s; }
    .rd-delay-9 { animation-delay: .45s; }

    .rd-float { animation: rdFloat 6s ease-in-out infinite; }

    .rd-card {
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .rd-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(249, 115, 22, 0.18);
    }
    .rd-icon-wrap {
        transition: transform .35s cubic-bezier(.34,1.56,.64,1);
    }
    .rd-card:hover .rd-icon-wrap {
        transform: scale(1.12) rotate(-6deg);
    }

    .rd-quick-btn {
        transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .rd-quick-btn:hover {
        transform: translateY(-3px);
    }

    .rd-row-hover {
        transition: background-color .2s ease;
    }

    .rd-badge-dot {
        display: inline-block;
        width: .4rem;
        height: .4rem;
        border-radius: 9999px;
    }

    /* Respect reduced motion preferences */
    @media (prefers-reduced-motion: reduce) {
        .rd-animate, .rd-float {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }
        .rd-card:hover, .rd-card:hover .rd-icon-wrap, .rd-quick-btn:hover {
            transform: none !important;
        }
    }
</style>

<div class="rd-font-body">

    {{-- ===================== Welcome Hero ===================== --}}
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-br from-orange-500 via-red-500 to-pink-500 shadow-xl shadow-orange-200/50 mb-8 rd-animate">

        {{-- decorative floating blobs --}}
        <div class="absolute -top-10 -right-10 w-56 h-56 bg-white/10 rounded-full rd-float" aria-hidden="true"></div>
        <div class="absolute bottom-0 left-1/3 w-32 h-32 bg-white/10 rounded-full rd-float" style="animation-delay:1.5s" aria-hidden="true"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-5 items-center lg:h-81">

            <div class="lg:col-span-3 p-8 sm:p-10 lg:p-12">
                <span class="inline-flex items-center gap-2 text-xs font-semibold tracking-wide uppercase bg-white/20 text-white px-3 py-1 rounded-full backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                    {{ now()->format('l, d M') }}
                </span>

                <h1 class="rd-font-display mt-4 text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                    Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }}, Admin!
                </h1>

                <p class="mt-3 text-white/90 text-base sm:text-lg max-w-md">
                    Here's how your restaurant is performing today. Every order, table and dish — all in one place.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ url('/orders') }}" class="rd-quick-btn inline-flex items-center gap-2 bg-white text-orange-600 font-semibold px-5 py-3 rounded-xl shadow-lg shadow-black/10 hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        View Orders
                    </a>
                    <a href="{{ url('/menu') }}" class="rd-quick-btn inline-flex items-center gap-2 bg-white/15 text-white font-semibold px-5 py-3 rounded-xl border border-white/30 backdrop-blur-sm hover:bg-white/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h1a2 2 0 0 0 2-2V2"/><path d="M6 2v20"/><path d="M18 2c-2 2-3 5-3 9s1 7 3 9"/></svg>
                        Manage Menu
                    </a>
                </div>
            </div>

           <div class="lg:col-span-2 h-64 lg:h-full relative overflow-hidden">
    <img
        src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80"
        alt="Freshly plated restaurant dish"
        loading="lazy"
        onerror="this.style.display='none'"
        class="absolute inset-0 w-full h-full object-cover lg:rounded-r-3xl opacity-95"
    >

    <div
        class="absolute inset-0 bg-linear-to-l from-transparent to-orange-500/40 lg:rounded-r-3xl"
        aria-hidden="true">
    </div>
</div>

        </div>
    </div>

    {{-- ===================== Statistics ===================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- Total Orders --}}
        <div class="rd-card rd-animate rd-delay-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Orders</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $totalOrders }}">
                        {{ $totalOrders }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">All-time orders placed</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
            </div>
        </div>

        {{-- Customers --}}
        <div class="rd-card rd-animate rd-delay-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Customers</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $totalCustomers }}">
                        {{ $totalCustomers }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Registered guests</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
        </div>

        {{-- Reservations --}}
        <div class="rd-card rd-animate rd-delay-3 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Reservations</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $totalReservations }}">
                        {{ $totalReservations }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Upcoming & past bookings</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-yellow-50 text-yellow-500 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                </div>
            </div>
        </div>

        {{-- Menu Items --}}
        <div class="rd-card rd-animate rd-delay-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Menu Items</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $totalMenuItems }}">
                        {{ $totalMenuItems }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Dishes on your menu</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h1a2 2 0 0 0 2-2V2"/><path d="M6 2v20"/><path d="M18 2c-2 2-3 5-3 9s1 7 3 9"/></svg>
                </div>
            </div>
        </div>

        {{-- Revenue --}}
        <div class="rd-card rd-animate rd-delay-5 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Revenue</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-emerald-700 mt-2">
                        Rs. {{ number_format($totalRevenue, 2) }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Total income earned</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
            </div>
        </div>

        {{-- Expenses --}}
        <div class="rd-card rd-animate rd-delay-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Expenses</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-red-700 mt-2">
                        Rs. {{ number_format($totalExpenses, 2) }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Total spend so far</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12H3M3 12l6-6M3 12l6 6"/><path d="M17 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2"/></svg>
                </div>
            </div>
        </div>

        {{-- Available Tables --}}
        <div class="rd-card rd-animate rd-delay-7 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Available Tables</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $availableTables }}">
                        {{ $availableTables }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Ready to be seated</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h18M5 10v9M19 10v9M3 6h18v4H3z"/></svg>
                </div>
            </div>
        </div>

        {{-- Kitchen Pending --}}
        <div class="rd-card rd-animate rd-delay-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Kitchen Pending</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $pendingKitchenOrders }}">
                        {{ $pendingKitchenOrders }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Orders being prepared</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"/><line x1="6" x2="18" y1="17" y2="17"/></svg>
                </div>
            </div>
        </div>

        {{-- Low Stock Ingredients --}}
        <div class="rd-card rd-animate rd-delay-9 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Low Stock Ingredients</p>
                    <h2 class="rd-font-display text-3xl font-extrabold text-gray-800 mt-2 rd-countup" data-target="{{ (int) $lowStockIngredients }}">
                        {{ $lowStockIngredients }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">Need restocking soon</p>
                </div>
                <div class="rd-icon-wrap w-12 h-12 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== Quick Actions ===================== --}}
    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 rd-animate">
        <h2 class="rd-font-display text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">

            <a href="{{ url('/orders/create') }}" class="rd-quick-btn flex flex-col items-center justify-center gap-2 rounded-xl p-4 bg-linear-to-br from-orange-50 to-orange-100 text-orange-700 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                <span class="text-xs font-semibold">New Order</span>
            </a>

            <a href="{{ url('/menu') }}" class="rd-quick-btn flex flex-col items-center justify-center gap-2 rounded-xl p-4 bg-linear-to-br from-red-50 to-red-100 text-red-700 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h1a2 2 0 0 0 2-2V2"/><path d="M6 2v20"/><path d="M18 2c-2 2-3 5-3 9s1 7 3 9"/></svg>
                <span class="text-xs font-semibold">Manage Menu</span>
            </a>

            <a href="{{ url('/reservations') }}" class="rd-quick-btn flex flex-col items-center justify-center gap-2 rounded-xl p-4 bg-linear-to-br from-yellow-50 to-yellow-100 text-yellow-700 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                <span class="text-xs font-semibold">Reservations</span>
            </a>

            <a href="{{ url('/kitchen') }}" class="rd-quick-btn flex flex-col items-center justify-center gap-2 rounded-xl p-4 bg-linear-to-br from-pink-50 to-pink-100 text-pink-700 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"/><line x1="6" x2="18" y1="17" y2="17"/></svg>
                <span class="text-xs font-semibold">Kitchen Orders</span>
            </a>

            <a href="{{ url('/customers') }}" class="rd-quick-btn flex flex-col items-center justify-center gap-2 rounded-xl p-4 bg-linear-to-br from-green-50 to-green-100 text-green-700 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                <span class="text-xs font-semibold">Customers</span>
            </a>

            <a href="{{ url('/inventory') }}" class="rd-quick-btn flex flex-col items-center justify-center gap-2 rounded-xl p-4 bg-linear-to-br from-indigo-50 to-indigo-100 text-indigo-700 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3M21 8H3M21 8v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8"/></svg>
                <span class="text-xs font-semibold">Inventory</span>
            </a>

        </div>

        <p class="text-xs text-gray-400 mt-3">
            Replace the links above with your actual <code class="bg-gray-100 px-1 py-0.5 rounded">route()</code> names if different from these paths.
        </p>
    </div>

    {{-- ===================== Recent Orders & Reservations ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        {{-- Recent Orders --}}
        <div class="rd-animate bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="border-b border-gray-100 p-5 flex items-center justify-between">
                <h2 class="rd-font-display text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    Recent Orders
                </h2>
                <a href="{{ url('/orders') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700">View all</a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 text-left font-semibold text-gray-500">Order #</th>
                                <th class="p-3 text-left font-semibold text-gray-500">Status</th>
                                <th class="p-3 text-left font-semibold text-gray-500">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recentOrders as $order)
                            @php
                                $statusRaw = strtolower($order->status ?? '');
                                $statusStyles = [
                                    'pending'   => 'bg-yellow-50 text-yellow-700',
                                    'completed' => 'bg-green-50 text-green-700',
                                    'delivered' => 'bg-green-50 text-green-700',
                                    'cancelled' => 'bg-red-50 text-red-700',
                                    'canceled'  => 'bg-red-50 text-red-700',
                                    'preparing' => 'bg-orange-50 text-orange-700',
                                    'processing'=> 'bg-blue-50 text-blue-700',
                                ];
                                $dotStyles = [
                                    'pending'   => 'bg-yellow-500',
                                    'completed' => 'bg-green-500',
                                    'delivered' => 'bg-green-500',
                                    'cancelled' => 'bg-red-500',
                                    'canceled'  => 'bg-red-500',
                                    'preparing' => 'bg-orange-500',
                                    'processing'=> 'bg-blue-500',
                                ];
                                $badgeClass = $statusStyles[$statusRaw] ?? 'bg-gray-100 text-gray-600';
                                $dotClass = $dotStyles[$statusRaw] ?? 'bg-gray-400';
                            @endphp
                            <tr class="rd-row-hover border-t border-gray-100 hover:bg-orange-50/40">
                                <td class="p-3 font-semibold text-gray-700">
                                    {{ $order->order_number }}
                                </td>
                                <td class="p-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                        <span class="rd-badge-dot {{ $dotClass }}"></span>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="p-3 font-semibold text-gray-800">
                                    Rs. {{ number_format($order->total_amount, 2) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-gray-300 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <p class="text-gray-400 text-sm font-medium">No orders found yet</p>
                </div>
            @endif

        </div>

        {{-- Recent Reservations --}}
        <div class="rd-animate bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="border-b border-gray-100 p-5 flex items-center justify-between">
                <h2 class="rd-font-display text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    Recent Reservations
                </h2>
                <a href="{{ url('/reservations') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700">View all</a>
            </div>

            @if($recentReservations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 text-left font-semibold text-gray-500">Customer</th>
                                <th class="p-3 text-left font-semibold text-gray-500">Date</th>
                                <th class="p-3 text-left font-semibold text-gray-500">Guests</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recentReservations as $reservation)
                            @php
                                $custName = $reservation->customer->name ?? 'N/A';
                                $initials = collect(explode(' ', trim($custName)))->map(fn($p) => mb_substr($p, 0, 1))->take(2)->implode('');
                                $initials = $initials !== '' ? strtoupper($initials) : 'NA';
                            @endphp
                            <tr class="rd-row-hover border-t border-gray-100 hover:bg-pink-50/40">
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <span class="w-8 h-8 rounded-full bg-linear-to-br from-orange-400 to-pink-500 text-white text-xs font-bold flex items-center justify-center shrink-0">
                                            {{ $initials }}
                                        </span>
                                        <span class="font-semibold text-gray-700">{{ $custName }}</span>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-600">
                                    {{ $reservation->reservation_date }}
                                </td>
                                <td class="p-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                                        {{ $reservation->guest_count }} guests
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-gray-300 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    <p class="text-gray-400 text-sm font-medium">No reservations found yet</p>
                </div>
            @endif

        </div>

    </div>

    {{-- ===================== Charts ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        <div class="rd-animate bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="rd-font-display text-lg font-bold text-gray-800">Monthly Revenue</h2>
                <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
            </div>
            <div class="relative" style="height: 280px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="rd-animate bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="rd-font-display text-lg font-bold text-gray-800">Monthly Expenses</h2>
                <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
            </div>
            <div class="relative" style="height: 280px;">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---------- Count-up animation for whole-number stats ----------
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.querySelectorAll('.rd-countup').forEach(function (el) {
        var target = parseInt(el.getAttribute('data-target'), 10);

        if (isNaN(target)) return;

        if (prefersReducedMotion) {
            el.textContent = target;
            return;
        }

        var duration = 900;
        var startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target);

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = target;
            }
        }

        requestAnimationFrame(step);
    });

    // ---------- Charts ----------
    if (typeof Chart === 'undefined') return;

    var revenueCtx = document.getElementById('revenueChart');

    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                datasets: [{
                    label: 'Revenue',
                    data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
                    backgroundColor: '#FB923C',
                    borderRadius: 8,
                    maxBarThickness: 36
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: prefersReducedMotion ? false : { duration: 900, easing: 'easeOutQuart' },
                plugins: {
                    legend: {
                        labels: { font: { family: 'Manrope' } }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (ctx) {
                                return ' Rs. ' + Number(ctx.parsed.y).toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F3F4F6' },
                        ticks: { font: { family: 'Manrope' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Manrope' } }
                    }
                }
            }
        });
    }

    var expenseCtx = document.getElementById('expenseChart');

    if (expenseCtx) {
        new Chart(expenseCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyExpenses->pluck('month')) !!},
                datasets: [{
                    label: 'Expenses',
                    data: {!! json_encode($monthlyExpenses->pluck('expense')) !!},
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#EF4444',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: prefersReducedMotion ? false : { duration: 900, easing: 'easeOutQuart' },
                plugins: {
                    legend: {
                        labels: { font: { family: 'Manrope' } }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (ctx) {
                                return ' Rs. ' + Number(ctx.parsed.y).toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F3F4F6' },
                        ticks: { font: { family: 'Manrope' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Manrope' } }
                    }
                }
            }
        });
    }

});
</script>
@endpush

@endsection