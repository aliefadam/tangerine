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
        Schema::create('member_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("member_id");
            $table->foreignId("trainer_id")->nullable();
            $table->foreignId("room_id")->nullable();
            $table->string("plan");
            // $table->string("day");
            // $table->string("time");
            $table->dateTime("subscribed_date");
            $table->dateTime("expired_date");
            $table->integer("remaining_session");
            $table->date('last_deducted_at')->nullable();
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_plans');
    }
};
