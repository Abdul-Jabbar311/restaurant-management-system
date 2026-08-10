<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Restaurant Management System</title>

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->

        <aside class="w-64 bg-gray-900 text-white">

            <div class="p-6 text-center border-b border-gray-700">

                <h2 class="text-2xl font-bold">
                    Restaurant
                </h2>

            </div>

            <nav class="mt-4">

                <!-- Dashboard -->

                <a href="{{ route('dashboard') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Dashboard
                </a>

                <!-- Admin Only -->

                @if(Auth::user()->role->name == 'Admin')

                    <a href="{{ route('roles.index') }}"
                       class="block px-6 py-3 hover:bg-blue-600">
                        Roles
                    </a>

                    <a href="{{ route('users.index') }}"
                       class="block px-6 py-3 hover:bg-blue-600">
                        Users
                    </a>

                @endif

                <!-- Admin & Manager -->

                <a href="{{ route('categories.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Categories
                </a>

                <a href="{{ route('menu-items.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Menu Items
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Suppliers
                </a>

                <a href="{{ route('ingredients.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Ingredients
                </a>

                <a href="{{ route('inventory-transactions.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Inventory
                </a>

                <a href="{{ route('expenses.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Expenses
                </a>

                <a href="{{ route('reports.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Reports
                </a>

                <a href="{{ route('attendances.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Attendance
                </a>

                <!-- Activity Logs -->

                @if(in_array(Auth::user()->role->name,['Admin','Manager']))

                    <a href="{{ route('activity-logs.index') }}"
                       class="block px-6 py-3 hover:bg-blue-600">
                        Activity Logs
                    </a>

                @endif

                <!-- Admin, Manager & Waiter -->

                <a href="{{ route('customers.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Customers
                </a>

                <a href="{{ route('orders.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Orders
                </a>

                <a href="{{ route('reservations.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Reservations
                </a>

                <a href="{{ route('restaurant-tables.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Restaurant Tables
                </a>

                <a href="{{ route('coupons.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Coupons
                </a>

                <a href="{{ route('feedback.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Feedback
                </a>

                <a href="{{ route('contacts.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Contacts
                </a>

                <!-- Admin & Chef -->

                <a href="{{ route('kitchen-orders.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    Kitchen
                </a>

                <!-- Admin & Waiter -->

                @if(in_array(Auth::user()->role->name, ['Admin', 'Waiter']))

                    <a href="{{ route('notifications.index') }}"
                       class="block px-6 py-3 hover:bg-blue-600">
                        🔔 Notifications
                    </a>

                @endif

                <!-- Admin -->

                @if(Auth::user()->role->name == 'Admin')

                    <a href="{{ route('settings.index') }}"
                       class="block px-6 py-3 hover:bg-blue-600">
                        Settings
                    </a>

                @endif

            </nav>

        </aside>
                <!-- Main Content -->

        <main class="flex-1 p-8">

            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center mb-6">

                <h2 class="text-xl font-semibold">
                    Welcome {{ Auth::user()->name }}
                </h2>

                <div class="flex items-center gap-4">

                    {{-- Notifications --}}

                    <a href="{{ route('notifications.index') }}"
                       class="relative bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">

                        🔔

                        @php
                            $unreadNotifications = \App\Models\Notification::where('user_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp

                        @if($unreadNotifications > 0)

                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $unreadNotifications }}
                            </span>

                        @endif

                    </a>

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                        {{ Auth::user()->role->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

            {{-- Success Message --}}

            @if(session('success'))

                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

                    {{ session('success') }}

                </div>

            @endif

            {{-- Error Message --}}

            @if(session('error'))

                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

                    {{ session('error') }}

                </div>

            @endif
                        {{-- Validation Errors --}}

            @if($errors->any())

                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

                    <ul class="list-disc ml-5">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            @yield('content')

        </main>

    </div>

    @stack('scripts')

</body>

</html>