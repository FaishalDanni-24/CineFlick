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
        // Buat tabel films
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('publisher');
            $table->year('released_year');
            $table->string('genre');
            $table->integer('duration_mins');
            $table->text('sinopsis');
            $table->decimal('rating', 2, 1);
            $table->string('poster_path')->nullable(); // Gambar poster bisa kosong
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pastikan nilai di kolom ini hanya diisi user_id dengan role admin
            $table->timestamps();

            $table->unique(['title', 'publisher', 'released_year']); // Gabungan kolom ini harus unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
