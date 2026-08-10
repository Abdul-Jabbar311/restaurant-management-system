<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Expense;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\KitchenOrder;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalSales = Order::sum('total_amount');

        $totalExpenses = Expense::sum('amount');

        $profit = $totalSales - $totalExpenses;

        $totalOrders = Order::count();

        $totalCustomers = Customer::count();

        $totalReservations = Reservation::count();

        $pendingKitchenOrders = KitchenOrder::where('status', 'Pending')->count();

        $stockIn = InventoryTransaction::where('transaction_type', 'Stock In')->sum('quantity');

        $stockOut = InventoryTransaction::where('transaction_type', 'Stock Out')->sum('quantity');

        $monthlySales = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $monthlyExpenses = Expense::select(
                DB::raw('MONTH(expense_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy(DB::raw('MONTH(expense_date)'))
            ->orderBy(DB::raw('MONTH(expense_date)'))
            ->get();

        return view('reports.index', compact(
            'totalSales',
            'totalExpenses',
            'profit',
            'totalOrders',
            'totalCustomers',
            'totalReservations',
            'pendingKitchenOrders',
            'stockIn',
            'stockOut',
            'monthlySales',
            'monthlyExpenses'
        ));
    }
}