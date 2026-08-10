<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::with('category');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('category', function ($category) use ($request) {

                        $category->where(
                            'name',
                            'like',
                            '%' . $request->search . '%'
                        );

                  });

            });

        }

        $menuItems = $query
            ->latest()
            ->paginate(10);

        return view('menu-items.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();

        return view('menu-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'preparation_time' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('menu-items', 'public');

        }

        MenuItem::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'preparation_time' => $request->preparation_time,
            'image' => $image,
            'is_available' => true,
            'is_featured' => false,
        ]);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu Item Added Successfully.');
    }

    public function show(MenuItem $menuItem)
    {
        return view('menu-items.show', compact('menuItem'));
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::where('is_active', true)->get();

        return view('menu-items.edit', compact(
            'menuItem',
            'categories'
        ));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'preparation_time' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = $menuItem->image;

        if ($request->hasFile('image')) {

            if ($menuItem->image) {

                Storage::disk('public')->delete($menuItem->image);

            }

            $image = $request->file('image')
                ->store('menu-items', 'public');
        }

        $menuItem->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'preparation_time' => $request->preparation_time,
            'image' => $image,
        ]);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu Item Updated Successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image) {

            Storage::disk('public')->delete($menuItem->image);

        }

        $menuItem->delete();

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu Item Deleted Successfully.');
    }
}