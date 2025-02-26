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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("trainer_id")->nullable();
            $table->string("plan");
            $table->date("subscription_date");
            $table->date("subscription_expiration_date");
            $table->string("status");
            $table->string("proof_of_payment")->nullable();
            $table->double("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
