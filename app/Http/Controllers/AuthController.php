<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\MenuItem;
use App\Models\Expense;
use App\Models\KitchenOrder;
use App\Models\Ingredient;
use App\Models\RestaurantTable;

use App\Services\ActivityLogService;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (!Auth::user()->is_active) {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Your account is inactive.',
                ]);
            }

            ActivityLogService::log(
                'Login',
                'Authentication',
                'User logged into the system.'
            );

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        $totalReservations = Reservation::count();
        $totalMenuItems = MenuItem::count();
        $totalExpenses = Expense::sum('amount');
        $totalRevenue = Order::sum('total_amount');
        $availableTables = RestaurantTable::where('status', 'Available')->count();
        $pendingKitchenOrders = KitchenOrder::where('status', 'Pending')->count();

        $lowStockIngredients = Ingredient::whereColumn(
            'stock_quantity',
            '<=',
            'minimum_stock'
        )->count();

        $recentOrders = Order::latest()
            ->take(5)
            ->get();

        $recentReservations = Reservation::latest()
            ->take(5)
            ->get();

        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyExpenses = Expense::selectRaw('MONTH(expense_date) as month, SUM(amount) as expense')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard.index', compact(
            'totalOrders',
            'totalCustomers',
            'totalReservations',
            'totalMenuItems',
            'totalExpenses',
            'totalRevenue',
            'availableTables',
            'pendingKitchenOrders',
            'lowStockIngredients',
            'recentOrders',
            'recentReservations',
            'monthlyRevenue',
            'monthlyExpenses'
        ));
    }

    public function logout(Request $request)
    {
        ActivityLogService::log(
            'Logout',
            'Authentication',
            'User logged out.'
        );

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}