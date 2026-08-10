<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::insert([

            [
                'category_id' => 1,
                'name' => 'Zinger Burger',
                'description' => 'Crispy chicken burger with cheese.',
                'price' => 650,
                'image' => 'zinger.jpg',
                'preparation_time' => 15,
                'is_available' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'name' => 'Beef Burger',
                'description' => 'Juicy grilled beef burger.',
                'price' => 750,
                'image' => 'beef.jpg',
                'preparation_time' => 18,
                'is_available' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'name' => 'Chicken Fajita Pizza',
                'description' => 'Large chicken fajita pizza.',
                'price' => 1450,
                'image' => 'pizza.jpg',
                'preparation_time' => 25,
                'is_available' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 5,
                'name' => 'Coca Cola',
                'description' => 'Chilled soft drink.',
                'price' => 120,
                'image' => 'coke.jpg',
                'preparation_time' => 2,
                'is_available' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 6,
                'name' => 'Chocolate Cake',
                'description' => 'Fresh chocolate cake slice.',
                'price' => 450,
                'image' => 'cake.jpg',
                'preparation_time' => 5,
                'is_available' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}