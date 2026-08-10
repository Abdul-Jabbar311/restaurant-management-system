<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::insert([

            [
                'name' => 'Fresh Foods Pvt Ltd',
                'contact_person' => 'Ahmed Ali',
                'phone' => '03001234567',
                'email' => 'freshfoods@example.com',
                'address' => 'Islamabad',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'National Meat Suppliers',
                'contact_person' => 'Usman Khan',
                'phone' => '03111234567',
                'email' => 'meat@example.com',
                'address' => 'Rawalpindi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}