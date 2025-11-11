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
        /**
         * Buat data fake film (untuk testing)
         * Pastikan user_id menunjuk ke user dengan role admin di tabel users.
         */
        DB::table('films')->upsert([
            [
                'title' => 'Mr Thinker',
                'publisher' => 'Broken Arrow Studio',
                'released_year' => 2025,
                'genre' => 'Biography',
                'duration_mins' => 160,
                'sinopsis' => 'Placeholder_Sinopsis_Biography',
                'rating' => 8.2,
                'poster_path' => 'poster/fake_film1.png',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Jalan Malam Kenangan',
                'publisher' => 'Budi Cahya Studio',
                'released_year' => 2025,
                'genre' => 'Drama',
                'duration_mins' => 120,
                'sinopsis' => 'Placeholder_Sinopsis_Drama',
                'rating' => 8.5,
                'poster_path' => 'poster/fake_film2.png',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'The Third One',
                'publisher' => 'Beyond Dreams',
                'released_year' => 2025,
                'genre' => 'Adventure',
                'duration_mins' => 110,
                'sinopsis' => 'Placeholder_Sinopsis_Adventure',
                'rating' => 7.0,
                'poster_path' => 'poster/fake_film3.png',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['title', 'publisher', 'released_year'], 
        ['title', 'publisher', 'released_year', 'genre', 'duration_mins', 'sinopsis', 'rating', 'poster_path' ,'user_id', 'updated_at']);
    }
}
