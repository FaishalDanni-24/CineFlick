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
        // Buat tabel food_drinks
        Schema::create('food_drinks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama makanan/minuman harus unik
            $table->enum('type', ['food','drink']);
            $table->decimal('price', 10, 2); // Harga per makanan/minuman
            $table->string('imagepath')->nullable(); // Link gambar makanan/minuman
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_drinks');
    }
};
