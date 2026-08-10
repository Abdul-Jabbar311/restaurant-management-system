<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\MenuItem;

class ExportController extends Controller
{
    public function orders()
    {
        $orders = Order::with('customer')->latest()->get();

        $pdf = Pdf::loadView('exports.orders', compact('orders'));

        return $pdf->download('orders.pdf');
    }

    public function users()
    {
        $users = User::with('role')->get();

        $pdf = Pdf::loadView('exports.users', compact('users'));

        return $pdf->download('users.pdf');
    }

    public function customers()
    {
        $customers = Customer::all();

        $pdf = Pdf::loadView('exports.customers', compact('customers'));

        return $pdf->download('customers.pdf');
    }

    public function expenses()
    {
        $expenses = Expense::latest()->get();

        $pdf = Pdf::loadView('exports.expenses', compact('expenses'));

        return $pdf->download('expenses.pdf');
    }

    public function menuItems()
    {
        $menuItems = MenuItem::with('category')->get();

        $pdf = Pdf::loadView('exports.menu-items', compact('menuItems'));

        return $pdf->download('menu-items.pdf');
    }
}