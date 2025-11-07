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
            $table->integer('year');
            $table->integer('duration_mins');
            $table->text('sinopsis');
            $table->decimal('normal_price', 10, 2);
            $table->string('poster_link')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['title', 'publisher', 'year']);
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
