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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable(false);
            $table->foreignId("room_id")->nullable(false);
            $table->time('started_time')->nullable(false);
            $table->time('end_time')->nullable(false);
            $table->enum('status', ['pending', 'ongoing', 'expired'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
