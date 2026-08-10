<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::insert([

            [
                'name' => 'Ali Khan',
                'phone' => '03001234567',
                'email' => 'ali@example.com',
                'address' => 'Islamabad',
                'loyalty_points' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Sara Ahmed',
                'phone' => '03111234567',
                'email' => 'sara@example.com',
                'address' => 'Rawalpindi',
                'loyalty_points' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}