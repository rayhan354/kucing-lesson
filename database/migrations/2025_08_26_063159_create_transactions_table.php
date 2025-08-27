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
            $table->string('booking_trx_id'); // Booking transaction ID

            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('pricing_id')->constrained()->onDelete('cascade'); // Foreign key to pricing table

            $table->unsignedInteger('sub_total_amount'); // Subtotal amount
            $table->unsignedInteger('grand_total_amount'); // Grand total amount
            $table->unsignedInteger('total_tax_amount'); // Grand total amount

            $table->boolean('is_paid'); // Payment status

            $table->string('payment_type'); // Payment type (e.g., card, bank transfer)

            $table->string('proof')->nullable(); // Optional proof of payment

            $table->date('started_at');
            $table->date('ended_at');

            $table->timestamps(); // Created at and updated at
            $table->softDeletes();
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
