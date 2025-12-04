<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Buat data default showtime (untuk testing)
         * Beberapa asumsi yang digunakan untuk pengaturan data default, maksimum durasi film 3 jam (180 menit), 
         * 10 menit untuk maintenance studios, maksimal 3 film tayang per hari,
         * jam film pertama mulai tayang adalah jam 12.00, jam film terakhir selesai tayang adalah jam 21.00
         * Logika backend: untuk menghitung nilai end_time gunakan rumus, start_time dari tabel ini + duration_mins dari tabel films.
         */
        DB::table('showtimes')->upsert([
            [
                'show_date' => now(),
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
                'normal_price' => 35000.00,
                'film_id' => 1,
                'studio_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => now(),
                'start_time' => '14:10:00',
                'end_time' => '16:00:00',
                'normal_price' => 30000.00,
                'film_id' => 2,
                'studio_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => now(),
                'start_time' => '16:10:00',
                'end_time' => '18:50:00',
                'normal_price' => 40000.00,
                'film_id' => 3,
                'studio_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => now(),
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
                'normal_price' => 35000.00,
                'film_id' => 1,
                'studio_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => now(),
                'start_time' => '14:10:00',
                'end_time' => '16:00:00',
                'normal_price' => 30000.00,
                'film_id' => 2,
                'studio_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => now(),
                'start_time' => '16:10:00',
                'end_time' => '18:50:00',
                'normal_price' => 40000.00,
                'film_id' => 3,
                'studio_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => Carbon::tomorrow(),
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
                'normal_price' => 35000.00,
                'film_id' => 1,
                'studio_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => Carbon::tomorrow(),
                'start_time' => '14:10:00',
                'end_time' => '16:00:00',
                'normal_price' => 30000.00,
                'film_id' => 2,
                'studio_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => Carbon::tomorrow(),
                'start_time' => '16:10:00',
                'end_time' => '18:50:00',
                'normal_price' => 40000.00,
                'film_id' => 3,
                'studio_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => Carbon::tomorrow(),
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
                'normal_price' => 35000.00,
                'film_id' => 1,
                'studio_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => Carbon::tomorrow(),
                'start_time' => '14:10:00',
                'end_time' => '16:00:00',
                'normal_price' => 30000.00,
                'film_id' => 2,
                'studio_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'show_date' => Carbon::tomorrow(),
                'start_time' => '16:10:00',
                'end_time' => '18:50:00',
                'normal_price' => 40000.00,
                'film_id' => 3,
                'studio_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ], ['show_date', 'start_time', 'end_time', 'studio_id'], 
        ['show_date', 'start_time', 'end_time', 'normal_price', 'film_id', 'studio_id', 'user_id', 'updated_at']);
    }
}
