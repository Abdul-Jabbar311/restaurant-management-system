<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('editable_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('key');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->unique(['page', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('editable_contents');
    }
};