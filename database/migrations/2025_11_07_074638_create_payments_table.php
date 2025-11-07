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
        // Buat tabel payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('method', ['E-Wallet', 'QRIS', 'VA']);
            $table->decimal('amount', 10, 2); // Jumlah pembayaran
            $table->datetime('payment_date')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique('booking_id'); // Satu payment hanya mengarah ke satu booking (One to One)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
