<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   public function run(): void
{
   $this->call([
    RoleSeeder::class,
    UserSeeder::class,
    RestaurantTableSeeder::class,
    CategorySeeder::class,
    MenuItemSeeder::class,
    CustomerSeeder::class,
    ReservationSeeder::class,
    OrderSeeder::class,
    OrderItemSeeder::class,
    PaymentSeeder::class,
    SupplierSeeder::class,
    IngredientSeeder::class,
    InventoryTransactionSeeder::class,
    AttendanceSeeder::class,
    ExpenseSeeder::class,
    KitchenOrderSeeder::class,
    NotificationSeeder::class,
    SettingSeeder::class,
CouponSeeder::class,
FeedbackSeeder::class,
]);
}
}