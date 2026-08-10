<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ActivityLogService;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {

            $query->where('name', 'like', '%' . $request->search . '%');

        }

        $categories = $query
            ->latest()
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('categories', 'public');

        }

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'is_active' => true,
        ]);

        ActivityLogService::log(
            'Create',
            'Categories',
            'Created Category: ' . $category->name
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Added Successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($category->image) {

                Storage::disk('public')->delete($category->image);

            }

            $category->image = $request->file('image')
                ->store('categories', 'public');

        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        ActivityLogService::log(
            'Update',
            'Categories',
            'Updated Category: ' . $category->name
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Updated Successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {

            Storage::disk('public')->delete($category->image);

        }

        ActivityLogService::log(
            'Delete',
            'Categories',
            'Deleted Category: ' . $category->name
        );

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Deleted Successfully.');
    }
}