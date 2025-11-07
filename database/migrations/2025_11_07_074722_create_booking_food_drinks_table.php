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
        // Buat tabel pivot (aggregasi) booking_food_drinks
        Schema::create('booking_food_drinks', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2); // Jumlah harga per jenis makanan/minuman
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_drink_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['booking_id', 'food_drink_id']); // Gabungan kolom ini harus unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_food_drinks');
    }
};
