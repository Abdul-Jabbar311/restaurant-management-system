<?php

namespace Database\Seeders;

use App\Models\InventoryTransaction;
use Illuminate\Database\Seeder;

class InventoryTransactionSeeder extends Seeder
{
    public function run(): void
    {
        InventoryTransaction::insert([

            [
                'ingredient_id' => 1,
                'transaction_type' => 'Stock In',
                'quantity' => 20,
                'reference' => 'PUR-1001',
                'notes' => 'Purchased from supplier',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'ingredient_id' => 1,
                'transaction_type' => 'Stock Out',
                'quantity' => 5,
                'reference' => 'ORD-0001',
                'notes' => 'Used in kitchen',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'ingredient_id' => 2,
                'transaction_type' => 'Stock In',
                'quantity' => 15,
                'reference' => 'PUR-1002',
                'notes' => 'Purchased from supplier',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}