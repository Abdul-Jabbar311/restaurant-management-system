<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::insert([

            [
                'user_id'=>1,
                'title'=>'Welcome',
                'message'=>'Welcome to Restaurant Management System',
                'is_read'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'user_id'=>2,
                'title'=>'New Reservation',
                'message'=>'A new reservation has been received.',
                'is_read'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

        ]);
    }
}