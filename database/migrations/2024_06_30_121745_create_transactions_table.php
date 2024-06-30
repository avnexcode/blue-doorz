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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable(false);
            $table->foreignId("room_id")->nullable(false);
            $table->date('started_time')->nullable(false);
            $table->date('end_time')->nullable(false);
            $table->string('total_price', 255)->nullable(false);
            $table->string('phone', 255)->nullable(false);
            $table->string('nik', 255)->nullable(false);
            $table->string('total_day', 255)->nullable(false);
            $table->enum('payment_method', ["cash", "dana", "credit"])->nullable(false);
            $table->enum('status', ['pending', 'ongoing', 'expired', 'canceled'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
