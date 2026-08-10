<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryTransaction::with('ingredient');

        if ($request->filled('search')) {

            $query->whereHas('ingredient', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            })->orWhere('transaction_type', 'like', '%' . $request->search . '%');

        }

        $transactions = $query
            ->latest()
            ->paginate(10);

        return view('inventory-transactions.index', compact('transactions'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();

        return view('inventory-transactions.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'transaction_type' => 'required|in:Stock In,Stock Out',
            'quantity' => 'required|numeric|min:0.01',
            'reference' => 'nullable|max:255',
            'notes' => 'nullable',
        ]);

        InventoryTransaction::create($validated);

        $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        if ($validated['transaction_type'] == 'Stock In') {

            $ingredient->stock_quantity += $validated['quantity'];

        } else {

            $ingredient->stock_quantity -= $validated['quantity'];

            if ($ingredient->stock_quantity < 0) {

                $ingredient->stock_quantity = 0;

            }

        }

        $ingredient->save();

        return redirect()
            ->route('inventory-transactions.index')
            ->with('success', 'Inventory Transaction Added Successfully.');
    }

    public function show(InventoryTransaction $inventoryTransaction)
    {
        return view('inventory-transactions.show', compact('inventoryTransaction'));
    }

    public function edit(InventoryTransaction $inventoryTransaction)
    {
        $ingredients = Ingredient::all();

        return view(
            'inventory-transactions.edit',
            compact('inventoryTransaction', 'ingredients')
        );
    }

    public function update(Request $request, InventoryTransaction $inventoryTransaction)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'transaction_type' => 'required|in:Stock In,Stock Out',
            'quantity' => 'required|numeric|min:0.01',
            'reference' => 'nullable|max:255',
            'notes' => 'nullable',
        ]);

        $inventoryTransaction->update($validated);

        return redirect()
            ->route('inventory-transactions.index')
            ->with('success', 'Inventory Transaction Updated Successfully.');
    }

    public function destroy(InventoryTransaction $inventoryTransaction)
    {
        $inventoryTransaction->delete();

        return redirect()
            ->route('inventory-transactions.index')
            ->with('success', 'Inventory Transaction Deleted Successfully.');
    }
}