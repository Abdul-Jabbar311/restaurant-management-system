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
    Schema::create('reservations', function (Blueprint $table) {

        $table->id();

        $table->foreignId('customer_id')
              ->constrained('customers')
              ->cascadeOnDelete();

        $table->foreignId('restaurant_table_id')
              ->constrained('restaurant_tables')
              ->cascadeOnDelete();

        $table->date('reservation_date');

        $table->time('reservation_time');

        $table->integer('number_of_guests');

        $table->enum('status', [
            'Pending',
            'Confirmed',
            'Cancelled',
            'Completed'
        ])->default('Pending');

        $table->text('special_request')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
