<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_item_ingredient', function (Blueprint $table) {

            $table->id();

            $table->foreignId('menu_item_id')
                ->constrained('menu_items')
                ->cascadeOnDelete();

            $table->foreignId('ingredient_id')
                ->constrained('ingredients')
                ->cascadeOnDelete();

            $table->decimal('quantity_required', 10, 3);

            $table->timestamps();

            // Prevent the same ingredient being added twice
            // to the same menu item.
            $table->unique([
                'menu_item_id',
                'ingredient_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_ingredient');
    }
};