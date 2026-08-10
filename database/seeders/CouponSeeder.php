<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::insert([

            [

                'code'=>'WELCOME10',

                'discount_percent'=>10,

                'expiry_date'=>'2027-12-31',

                'is_active'=>true,

                'created_at'=>now(),

                'updated_at'=>now(),

            ],

            [

                'code'=>'SUMMER20',

                'discount_percent'=>20,

                'expiry_date'=>'2027-10-31',

                'is_active'=>true,

                'created_at'=>now(),

                'updated_at'=>now(),

            ]

        ]);
    }
}