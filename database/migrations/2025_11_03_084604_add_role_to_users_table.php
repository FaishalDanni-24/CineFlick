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
            // Buat kolom role ke tabel users jika menjalankan php artisan migrate
            $table->enum('role', ['admin','customer'])->default('customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika menjalankan php artisan migrate:rollback maka hapus kolom role
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
