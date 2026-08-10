<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        Ingredient::insert([

            [
                'supplier_id' => 1,
                'name' => 'Chicken',
                'unit' => 'Kg',
                'stock_quantity' => 50,
                'minimum_stock' => 10,
                'cost_per_unit' => 850,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'supplier_id' => 2,
                'name' => 'Beef',
                'unit' => 'Kg',
                'stock_quantity' => 35,
                'minimum_stock' => 8,
                'cost_per_unit' => 1200,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'supplier_id' => 1,
                'name' => 'Rice',
                'unit' => 'Kg',
                'stock_quantity' => 100,
                'minimum_stock' => 20,
                'cost_per_unit' => 300,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}