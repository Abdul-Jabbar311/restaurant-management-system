<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of expenses
     */
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');

            });

        }

        $expenses = $query
            ->latest()
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store expense
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|in:Electricity,Gas,Salary,Maintenance,Rent,Other',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Expense::create($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Created Successfully.');
    }

    /**
     * Show expense details
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show edit form
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update expense
     */
   public function update(Request $request, Expense $expense)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'expense_date' => 'required|date',
        'description' => 'nullable|string',
    ]);

    $expense->update($validated);

    return redirect()
        ->route('expenses.index')
        ->with('success', 'Expense Updated Successfully.');
}
}