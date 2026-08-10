<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    Role::insert([
        [
            'name' => 'Admin',
            'description' => 'Full system access',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Manager',
            'description' => 'Manage restaurant operations',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Waiter',
            'description' => 'Take customer orders',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Chef',
            'description' => 'Prepare customer food',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Cashier',
            'description' => 'Handle payments',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}
}
