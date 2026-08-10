<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Category::insert([

        [
            'name' => 'Burgers',
            'image' => 'burgers.png',
            'description' => 'All burger items',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'name' => 'Pizza',
            'image' => 'pizza.png',
            'description' => 'All pizza items',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'name' => 'Main Course',
            'image' => 'main-course.png',
            'description' => 'Rice, Biryani and Karahi',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'name' => 'Fast Food',
            'image' => 'fast-food.png',
            'description' => 'Fries, Nuggets and Snacks',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'name' => 'Drinks',
            'image' => 'drinks.png',
            'description' => 'Soft Drinks and Juices',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'name' => 'Desserts',
            'image' => 'desserts.png',
            'description' => 'Ice Cream and Cakes',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'name' => 'Hot Drinks',
            'image' => 'hot-drinks.png',
            'description' => 'Tea and Coffee',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

    ]);
}
}
