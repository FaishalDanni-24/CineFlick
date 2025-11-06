<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data fake film (untuk testing)
        DB::table('films')->upsert([
            [
                'title' => 'Jalan Malam Kenangan',
                'publisher' => 'Budi Cahya Studio',
                'duration_mins' => 120,
                'sinopsis' => 'Placeholder_Sinopsis',
                'normal_price' => 30000.00,
                'poster_link' => '/storage/poster/fake_film1.png',
                'user_id' => 1, // Pada logika backend, pastikan role dari user_id adalah admin
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'The Third One',
                'publisher' => 'Beyond Dreams',
                'duration_mins' => 110,
                'sinopsis' => 'Placeholder_Sinopsis',
                'normal_price' => 40000.00,
                'poster_link' => '/storage/poster/fake_film2.png',
                'user_id' => 1, // Pada logika backend, pastikan role dari user_id adalah admin
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['id'], 
        ['title', 'publisher', 'duration_mins', 'sinopsis', 'normal_price', 'poster_link' ,'user_id', 'updated_at']);
    }
}
