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
        // Buat tabel showtimes
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->date('show_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('normal_price', 10, 2); // Harga tiket dasar (Sebelum disesuaikan sesuai logika backend)
            $table->foreignId('film_id')->constrained()->onDelete('cascade');
            $table->foreignId('studio_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pastikan nilai di kolom ini hanya diisi user_id dengan role admin
            $table->timestamps();

            $table->unique(['show_date', 'start_time', 'end_time', 'studio_id']); // Gabungan kolom ini harus unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
