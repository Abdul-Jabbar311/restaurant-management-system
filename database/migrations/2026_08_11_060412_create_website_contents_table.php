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
    Schema::create('website_contents', function (Blueprint $table) {
        $table->id();
        $table->string('page');
        $table->string('key');
        $table->text('content')->nullable();
        $table->timestamps();

        $table->unique(['page', 'key']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_contents');
    }
};
