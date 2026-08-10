<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    \App\Models\RestaurantTable::insert([

        [
            'table_number' => 'T-01',
            'table_name' => 'Window Table',
            'capacity' => 2,
            'location' => 'Indoor',
            'status' => 'Available',
            'qr_code' => 'QR-T01',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'table_number' => 'T-02',
            'table_name' => 'Family Table',
            'capacity' => 6,
            'location' => 'Indoor',
            'status' => 'Available',
            'qr_code' => 'QR-T02',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'table_number' => 'T-03',
            'table_name' => 'VIP Table',
            'capacity' => 8,
            'location' => 'First Floor',
            'status' => 'Reserved',
            'qr_code' => 'QR-T03',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'table_number' => 'T-04',
            'table_name' => 'Outdoor Table',
            'capacity' => 4,
            'location' => 'Outdoor',
            'status' => 'Available',
            'qr_code' => 'QR-T04',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'table_number' => 'T-05',
            'table_name' => 'Corner Table',
            'capacity' => 4,
            'location' => 'Indoor',
            'status' => 'Cleaning',
            'qr_code' => 'QR-T05',
            'created_at' => now(),
            'updated_at' => now(),
        ],

    ]);
}
}
