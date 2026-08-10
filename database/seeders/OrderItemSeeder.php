<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        OrderItem::insert([

            [
                'order_id' => 1,
                'menu_item_id' => 1,
                'quantity' => 2,
                'unit_price' => 500,
                'subtotal' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'order_id' => 1,
                'menu_item_id' => 2,
                'quantity' => 1,
                'unit_price' => 450,
                'subtotal' => 450,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'order_id' => 2,
                'menu_item_id' => 3,
                'quantity' => 2,
                'unit_price' => 490,
                'subtotal' => 980,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}