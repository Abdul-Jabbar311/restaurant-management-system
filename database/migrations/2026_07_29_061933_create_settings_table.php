<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            $table->string('restaurant_name');

            $table->string('phone');

            $table->string('email');

            $table->text('address');

            $table->decimal('tax_percentage',5,2)->default(15);

            $table->string('currency')->default('PKR');

            $table->string('logo')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};