<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingredient_menu_item', function (Blueprint $table) {

            $table->id();

            $table->foreignId('menu_item_id')
                ->constrained('menu_items')
                ->cascadeOnDelete();

            $table->foreignId('ingredient_id')
                ->constrained('ingredients')
                ->cascadeOnDelete();

            $table->decimal('quantity', 10, 3);

            $table->timestamps();

            $table->unique([
                'menu_item_id',
                'ingredient_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredient_menu_item');
    }
};