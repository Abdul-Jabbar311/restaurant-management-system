@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Reports Dashboard
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Total Sales</p>
        <h2 class="text-4xl font-bold text-green-600">
            Rs. {{ number_format($totalSales,2) }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Total Expenses</p>
        <h2 class="text-4xl font-bold text-red-600">
            Rs. {{ number_format($totalExpenses,2) }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Profit</p>
        <h2 class="text-4xl font-bold text-blue-600">
            Rs. {{ number_format($profit,2) }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Total Orders</p>
        <h2 class="text-4xl font-bold">
            {{ $totalOrders }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Customers</p>
        <h2 class="text-4xl font-bold">
            {{ $totalCustomers }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Reservations</p>
        <h2 class="text-4xl font-bold">
            {{ $totalReservations }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Pending Kitchen Orders</p>
        <h2 class="text-4xl font-bold text-orange-500">
            {{ $pendingKitchenOrders }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Stock In</p>
        <h2 class="text-4xl font-bold text-green-500">
            {{ number_format($stockIn,2) }}
        </h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Stock Out</p>
        <h2 class="text-4xl font-bold text-red-500">
            {{ number_format($stockOut,2) }}
        </h2>
    </div>

</div>

<div class="mt-10 bg-white shadow rounded-lg p-6">

    <h2 class="text-2xl font-bold mb-4">
        Monthly Sales
    </h2>

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>
                <th class="border p-3 text-left">Month</th>
                <th class="border p-3 text-left">Sales</th>
            </tr>

        </thead>

        <tbody>

        @forelse($monthlySales as $sale)

            <tr>

                <td class="border p-3">
                    {{ DateTime::createFromFormat('!m', $sale->month)->format('F') }}
                </td>

                <td class="border p-3">
                    Rs. {{ number_format($sale->total,2) }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="2" class="border p-4 text-center">
                    No Sales Data
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-10 bg-white shadow rounded-lg p-6">

    <h2 class="text-2xl font-bold mb-4">
        Monthly Expenses
    </h2>

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>
                <th class="border p-3 text-left">Month</th>
                <th class="border p-3 text-left">Expenses</th>
            </tr>

        </thead>

        <tbody>

        @forelse($monthlyExpenses as $expense)

            <tr>

                <td class="border p-3">
                    {{ DateTime::createFromFormat('!m', $expense->month)->format('F') }}
                </td>

                <td class="border p-3">
                    Rs. {{ number_format($expense->total,2) }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="2" class="border p-4 text-center">
                    No Expense Data
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection