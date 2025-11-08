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
        Schema::table('users', function (Blueprint $table) {
            // Buat kolom gender ke table users jika menjalankan php artisan migrate
            $table->enum('gender', ['laki-laki','perempuan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom gender jika menjalankan php artisan migrate:rollback
            $table->dropColumn('gender');
        });
    }
};
