<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    /**
     * Display all menu items
     */
    public function index(Request $request)
    {
        $query = MenuItem::with('category');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )

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

        return view(
            'menu-items.index',
            compact('menuItems')
        );
    }


    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::where(
            'is_active',
            true
        )->get();

        $ingredients = Ingredient::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();

        return view(
            'menu-items.create',
            compact(
                'categories',
                'ingredients'
            )
        );
    }


    /**
     * Store menu item
     */
    public function store(Request $request)
    {
        $request->validate([

            'category_id' =>
                'required|exists:categories,id',

            'name' =>
                'required|max:255',

            'description' =>
                'nullable',

            'price' =>
                'required|numeric|min:0',

            'preparation_time' =>
                'required|integer|min:0',

            'image' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Recipe ingredients
            'ingredients' =>
                'nullable|array',

            'ingredients.*.quantity' =>
                'nullable|numeric|min:0.001',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request
                ->file('image')
                ->store('menu-items', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Create Menu Item
        |--------------------------------------------------------------------------
        */

        $menuItem = MenuItem::create([

            'category_id' =>
                $request->category_id,

            'name' =>
                $request->name,

            'description' =>
                $request->description,

            'price' =>
                $request->price,

            'preparation_time' =>
                $request->preparation_time,

            'image' =>
                $image,

            'is_available' =>
                true,

            'is_featured' =>
                false,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Save Recipe / Ingredients
        |--------------------------------------------------------------------------
        |
        | Form format:
        |
        | ingredients[1][quantity] = 0.003
        | ingredients[3][quantity] = 0.100
        |
        */

        $recipe = [];

        foreach (
            $request->input('ingredients', [])
            as $ingredientId => $data
        ) {

            if (
                isset($data['quantity']) &&
                is_numeric($data['quantity']) &&
                $data['quantity'] > 0
            ) {

                $recipe[$ingredientId] = [
                    'quantity' => $data['quantity']
                ];
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Attach Ingredients
        |--------------------------------------------------------------------------
        */

        $menuItem
            ->ingredients()
            ->sync($recipe);


        return redirect()
            ->route('menu-items.index')
            ->with(
                'success',
                'Menu Item Added Successfully.'
            );
    }


    /**
     * Show menu item
     */
    public function show(MenuItem $menuItem)
    {
        $menuItem->load([
            'category',
            'ingredients'
        ]);

        return view(
            'menu-items.show',
            compact('menuItem')
        );
    }


    /**
     * Show edit form
     */
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::where(
            'is_active',
            true
        )->get();

        $ingredients = Ingredient::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();

        /*
        |--------------------------------------------------------------------------
        | Load Existing Recipe
        |--------------------------------------------------------------------------
        */

        $menuItem->load('ingredients');


        return view(
            'menu-items.edit',
            compact(
                'menuItem',
                'categories',
                'ingredients'
            )
        );
    }


    /**
     * Update menu item
     */
    public function update(
        Request $request,
        MenuItem $menuItem
    ) {

        $request->validate([

            'category_id' =>
                'required|exists:categories,id',

            'name' =>
                'required|max:255',

            'description' =>
                'nullable',

            'price' =>
                'required|numeric|min:0',

            'preparation_time' =>
                'required|integer|min:0',

            'image' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Recipe ingredients
            'ingredients' =>
                'nullable|array',

            'ingredients.*.quantity' =>
                'nullable|numeric|min:0.001',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Keep Existing Image
        |--------------------------------------------------------------------------
        */

        $image = $menuItem->image;


        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($menuItem->image) {

                Storage::disk('public')
                    ->delete($menuItem->image);
            }

            $image = $request
                ->file('image')
                ->store('menu-items', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update Menu Item
        |--------------------------------------------------------------------------
        */

        $menuItem->update([

            'category_id' =>
                $request->category_id,

            'name' =>
                $request->name,

            'description' =>
                $request->description,

            'price' =>
                $request->price,

            'preparation_time' =>
                $request->preparation_time,

            'image' =>
                $image,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Build Recipe
        |--------------------------------------------------------------------------
        */

        $recipe = [];

        foreach (
            $request->input('ingredients', [])
            as $ingredientId => $data
        ) {

            if (
                isset($data['quantity']) &&
                is_numeric($data['quantity']) &&
                $data['quantity'] > 0
            ) {

                $recipe[$ingredientId] = [
                    'quantity' => $data['quantity']
                ];
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Replace Existing Recipe
        |--------------------------------------------------------------------------
        */

        $menuItem
            ->ingredients()
            ->sync($recipe);


        return redirect()
            ->route('menu-items.index')
            ->with(
                'success',
                'Menu Item Updated Successfully.'
            );
    }


    /**
     * Delete menu item
     */
    public function destroy(MenuItem $menuItem)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Image
        |--------------------------------------------------------------------------
        */

        if ($menuItem->image) {

            Storage::disk('public')
                ->delete($menuItem->image);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Recipe
        |--------------------------------------------------------------------------
        */

        $menuItem
            ->ingredients()
            ->detach();


        /*
        |--------------------------------------------------------------------------
        | Delete Menu Item
        |--------------------------------------------------------------------------
        */

        $menuItem->delete();


        return redirect()
            ->route('menu-items.index')
            ->with(
                'success',
                'Menu Item Deleted Successfully.'
            );
    }
}