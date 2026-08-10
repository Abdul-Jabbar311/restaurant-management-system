<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([

            'restaurant_name'=>'Royal Restaurant',

            'phone'=>'0511234567',

            'email'=>'info@royalrestaurant.com',

            'address'=>'Islamabad, Pakistan',

            'tax_percentage'=>15,

            'currency'=>'PKR',

            'logo'=>null,

        ]);
    }
}