<?php

namespace Database\Seeders;

use App\Models\KitchenOrder;
use Illuminate\Database\Seeder;

class KitchenOrderSeeder extends Seeder
{
    public function run(): void
    {
        KitchenOrder::insert([

            [
                'order_id'=>1,
                'status'=>'Served',
                'started_at'=>now(),
                'completed_at'=>now(),
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'order_id'=>2,
                'status'=>'Preparing',
                'started_at'=>now(),
                'completed_at'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

        ]);
    }
}