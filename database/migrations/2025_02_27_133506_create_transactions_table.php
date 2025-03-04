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
            $table->string("invoice");
            $table->foreignId("user_id");
            $table->foreignId("trainer_id")->nullable();
            $table->foreignId("room_id")->nullable();
            $table->string("plan");
            $table->string("date")->nullable();
            $table->string("time")->nullable();

            // untuk kebutuhan validasi kapasitas
            $table->integer("capacity")->nullable();

            $table->string("payment_status");
            $table->string("proof_of_payment")->nullable();
            $table->double("total");
            $table->text("notes")->nullable();
            $table->dateTime("expirated_date");
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
