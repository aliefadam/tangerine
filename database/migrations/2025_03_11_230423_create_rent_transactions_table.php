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
        Schema::create('rent_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("invoice");
            $table->integer("participant");
            $table->string("room_type");
            $table->string("used_for");
            $table->double("price");
            $table->integer("hour");
            $table->double("total");
            $table->string("proof_of_payment")->nullable();
            $table->string("status");
            $table->dateTime("expirated_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_transactions');
    }
};
