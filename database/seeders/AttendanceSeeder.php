<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        Attendance::insert([

            [
                'user_id' => 2,
                'attendance_date' => now()->toDateString(),
                'check_in' => '09:00:00',
                'check_out' => '18:00:00',
                'status' => 'Present',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3,
                'attendance_date' => now()->toDateString(),
                'check_in' => '09:20:00',
                'check_out' => '18:00:00',
                'status' => 'Late',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 4,
                'attendance_date' => now()->toDateString(),
                'check_in' => '09:00:00',
                'check_out' => '18:00:00',
                'status' => 'Present',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}