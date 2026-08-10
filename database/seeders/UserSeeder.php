<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::insert([

        [
            'role_id' => 1,
            'name' => 'System Admin',
            'email' => 'admin@restaurant.com',
            'phone' => '03000000001',
            'password' => Hash::make('admin123'),
            'profile_image' => null,
            'is_active' => true,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'role_id' => 2,
            'name' => 'Restaurant Manager',
            'email' => 'manager@restaurant.com',
            'phone' => '03000000002',
            'password' => Hash::make('manager123'),
            'profile_image' => null,
            'is_active' => true,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'role_id' => 3,
            'name' => 'Ali Waiter',
            'email' => 'waiter@restaurant.com',
            'phone' => '03000000003',
            'password' => Hash::make('waiter123'),
            'profile_image' => null,
            'is_active' => true,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'role_id' => 4,
            'name' => 'Ahmed Chef',
            'email' => 'chef@restaurant.com',
            'phone' => '03000000004',
            'password' => Hash::make('chef123'),
            'profile_image' => null,
            'is_active' => true,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'role_id' => 5,
            'name' => 'Hassan Cashier',
            'email' => 'cashier@restaurant.com',
            'phone' => '03000000005',
            'password' => Hash::make('cashier123'),
            'profile_image' => null,
            'is_active' => true,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],

    ]);
}
}
