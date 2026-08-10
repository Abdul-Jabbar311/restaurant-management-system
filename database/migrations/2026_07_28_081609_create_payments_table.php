<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnDelete();

            $table->decimal('amount',10,2);

            $table->enum('payment_method',[
                'Cash',
                'Card',
                'Online'
            ]);

            $table->string('transaction_id')->nullable();

            $table->enum('payment_status',[
                'Pending',
                'Completed',
                'Failed'
            ])->default('Completed');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};