<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Restaurant Table
            $table->foreignId('restaurant_table_id')
                  ->constrained('restaurant_tables')
                  ->cascadeOnDelete();

            // Customer (Optional for walk-in customers)
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained('customers')
                  ->nullOnDelete();

            // Waiter
            $table->foreignId('waiter_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Order Number
            $table->string('order_number')->unique();

            // Order Status
            $table->enum('status', [
                'Pending',
                'Preparing',
                'Ready',
                'Completed',
                'Cancelled'
            ])->default('Pending');

            // Payment Status
            $table->enum('payment_status', [
                'Unpaid',
                'Paid'
            ])->default('Unpaid');

            // Total Bill
            $table->decimal('total_amount', 10, 2)->default(0);

            // Special Instructions
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};