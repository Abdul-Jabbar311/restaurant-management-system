<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::insert([

            [
                'order_id' => 1,
                'amount' => 1450,
                'payment_method' => 'Cash',
                'transaction_id' => null,
                'payment_status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'order_id' => 2,
                'amount' => 980,
                'payment_method' => 'Card',
                'transaction_id' => 'TXN123456',
                'payment_status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}