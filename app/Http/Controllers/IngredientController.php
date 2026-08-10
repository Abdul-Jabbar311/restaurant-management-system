<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Supplier;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::with('supplier');

        if ($request->filled('search')) {

            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('supplier', function ($q) use ($request) {

                      $q->where('name', 'like', '%' . $request->search . '%');

                  });

        }

        $ingredients = $query
            ->latest()
            ->paginate(10);

        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('ingredients.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|max:255',
            'unit' => 'required|max:50',
            'stock_quantity' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
        ]);

        Ingredient::create([
            'supplier_id' => $validated['supplier_id'],
            'name' => $validated['name'],
            'unit' => $validated['unit'],
            'stock_quantity' => $validated['stock_quantity'],
            'minimum_stock' => $validated['minimum_stock'],
            'cost_per_unit' => $validated['cost_per_unit'],
            'is_active' => 1,
        ]);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient Created Successfully.');
    }

    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient)
    {
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('ingredients.edit', compact(
            'ingredient',
            'suppliers'
        ));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|max:255',
            'unit' => 'required|max:50',
            'stock_quantity' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $ingredient->update($validated);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient Updated Successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient Deleted Successfully.');
    }
}