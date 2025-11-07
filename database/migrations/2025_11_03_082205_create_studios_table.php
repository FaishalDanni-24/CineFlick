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
        // Buat tabel dengan nama studios
        Schema::create('studios', function (Blueprint $table) {
            // Buat kolom pada tabel studios
            $table->id();
            $table->string('studio_name')->unique(); // Nama studio harus unik
            $table->integer('seat_capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika menjalankan php artisan migrate:rollback maka hapus tabel studios
        Schema::dropIfExists('studios');
    }
};
