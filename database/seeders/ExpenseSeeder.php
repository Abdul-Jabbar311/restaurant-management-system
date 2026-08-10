<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::insert([

            [
                'title' => 'Electricity Bill',
                'category' => 'Electricity',
                'amount' => 25000,
                'expense_date' => now()->toDateString(),
                'description' => 'Monthly electricity bill',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Gas Bill',
                'category' => 'Gas',
                'amount' => 12000,
                'expense_date' => now()->toDateString(),
                'description' => 'Kitchen gas',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Kitchen Maintenance',
                'category' => 'Maintenance',
                'amount' => 8000,
                'expense_date' => now()->toDateString(),
                'description' => 'Equipment repair',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}