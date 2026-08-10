<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::insert([

            [
                'restaurant_table_id' => 1,
                'waiter_id' => 3,
                'order_number' => 'ORD-0001',
                'status' => 'Completed',
                'payment_status' => 'Paid',
                'total_amount' => 1450.00,
                'notes' => 'Extra ketchup',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'restaurant_table_id' => 2,
                'waiter_id' => 3,
                'order_number' => 'ORD-0002',
                'status' => 'Preparing',
                'payment_status' => 'Unpaid',
                'total_amount' => 980.00,
                'notes' => 'No onions',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}