<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        Feedback::insert([

            [
                'customer_id' => 1,
                'rating' => 5,
                'comment' => 'Excellent food and service.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 2,
                'rating' => 4,
                'comment' => 'Nice environment and tasty food.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}