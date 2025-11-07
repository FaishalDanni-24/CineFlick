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
        // Buat tabel data tickets
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->decimal('ticket_price'); // Harga per tiket
            $table->string('qr_code')->nullable(); // Link ke kode QR
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('seat_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['booking_id','seat_id']); // Gabungan booking_id dan seat_id harus unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
