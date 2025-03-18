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
        Schema::create('booking_salons', function (Blueprint $table) {
            $table->id();
            $table->string("invoice");
            $table->foreignId('user_id');
            $table->foreignId('schedule_id');
            $table->foreignId('service_id');
            $table->date('booking_date');
            $table->string('customer_name');
            $table->string('phone_number');
            // $table->string('payment_proof');
            $table->integer('queue_number')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_salons');
    }
};
