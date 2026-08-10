<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::insert([

            [
                'customer_id' => 1,
                'restaurant_table_id' => 2,
                'reservation_date' => now()->toDateString(),
                'reservation_time' => '19:00:00',
                'number_of_guests' => 4,
                'status' => 'Confirmed',
                'special_request' => 'Window seat',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 2,
                'restaurant_table_id' => 5,
                'reservation_date' => now()->addDay()->toDateString(),
                'reservation_time' => '20:30:00',
                'number_of_guests' => 2,
                'status' => 'Pending',
                'special_request' => 'Birthday decoration',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}