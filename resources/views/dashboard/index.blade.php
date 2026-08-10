@extends('layouts.app')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard
    </h1>

    <p class="text-gray-500 mt-2">
        Welcome back! Here's your restaurant overview.
    </p>

</div>

<!-- Statistics -->

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Total Orders</p>
        <h2 class="text-4xl font-bold text-blue-600 mt-2">
            {{ $totalOrders }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Customers</p>
        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $totalCustomers }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Reservations</p>
        <h2 class="text-4xl font-bold text-yellow-500 mt-2">
            {{ $totalReservations }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Menu Items</p>
        <h2 class="text-4xl font-bold text-red-600 mt-2">
            {{ $totalMenuItems }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Revenue</p>
        <h2 class="text-4xl font-bold text-green-700 mt-2">
            Rs. {{ number_format($totalRevenue,2) }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Expenses</p>
        <h2 class="text-4xl font-bold text-red-700 mt-2">
            Rs. {{ number_format($totalExpenses,2) }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Available Tables</p>
        <h2 class="text-4xl font-bold text-indigo-600 mt-2">
            {{ $availableTables }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Kitchen Pending</p>
        <h2 class="text-4xl font-bold text-orange-500 mt-2">
            {{ $pendingKitchenOrders }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Low Stock Ingredients</p>
        <h2 class="text-4xl font-bold text-pink-600 mt-2">
            {{ $lowStockIngredients }}
        </h2>
    </div>

</div>

<!-- Recent Tables -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-4">
            <h2 class="text-xl font-semibold">
                Recent Orders
            </h2>
        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">Order #</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Amount</th>

                </tr>

            </thead>

            <tbody>

            @forelse($recentOrders as $order)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $order->order_number }}
                    </td>

                    <td class="p-3">
                        {{ $order->status }}
                    </td>

                    <td class="p-3">
                        Rs. {{ number_format($order->total_amount,2) }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="p-4 text-center">

                        No Orders Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-4">

            <h2 class="text-xl font-semibold">

                Recent Reservations

            </h2>

        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Guests</th>

                </tr>

            </thead>

            <tbody>

            @forelse($recentReservations as $reservation)

                <tr class="border-t">

                    <td class="p-3">

                        {{ $reservation->customer->name ?? 'N/A' }}

                    </td>

                    <td class="p-3">

                        {{ $reservation->reservation_date }}

                    </td>

                    <td class="p-3">

                        {{ $reservation->guest_count }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="p-4 text-center">

                        No Reservations Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- Charts -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-semibold mb-4">

            Monthly Revenue

        </h2>

        <canvas id="revenueChart"></canvas>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-semibold mb-4">

            Monthly Expenses

        </h2>

        <canvas id="expenseChart"></canvas>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    if (typeof Chart === 'undefined') return;

    const revenueCtx = document.getElementById('revenueChart');

    if (revenueCtx) {

        new Chart(revenueCtx, {

            type: 'bar',

            data: {

                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},

                datasets: [{

                    label: 'Revenue',

                    data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},

                    backgroundColor: '#3B82F6'

                }]

            }

        });

    }

    const expenseCtx = document.getElementById('expenseChart');

    if (expenseCtx) {

        new Chart(expenseCtx, {

            type: 'line',

            data: {

                labels: {!! json_encode($monthlyExpenses->pluck('month')) !!},

                datasets: [{

                    label: 'Expenses',

                    data: {!! json_encode($monthlyExpenses->pluck('expense')) !!},

                    borderColor: '#EF4444',

                    backgroundColor: '#FCA5A5',

                    fill: false,

                    tension: 0.4

                }]

            }

        });

    }

});

</script>

@endpush

@endsection