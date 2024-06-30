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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable(true);
            $table->string('name', 100)->nullable(false);
            $table->string('room_number', 100)->nullable(false)->unique();
            $table->string('slug', 100)->nullable(false)->unique();
            $table->string('image', 255)->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('price', 50)->nullable(false);
            $table->enum('status', ['booked', 'available'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
