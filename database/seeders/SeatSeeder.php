<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Buat data default seats (untuk testing)
         * berdasarkan asumsi dari tabel studios, 40 kursi total per studio,
         * seat_row : A-E
         * seat_number: 1-8
         */
        foreach(range('A', 'E') as $row){
            for($num = 1; $num <= 8; $num++){
                DB::table('seats')->upsert([
                    'seat_row' => $row,
                    'seat_number' => $num,
                    'studio_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],['seat_row', 'seat_number', 'studio_id'],
                ['seat_row', 'seat_number', 'studio_id','updated_at']);
            }
        }
        foreach(range('A', 'E') as $row){
            for($num = 1; $num <= 8; $num++){
                DB::table('seats')->upsert([
                    'seat_row' => $row,
                    'seat_number' => $num,
                    'studio_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],['seat_row', 'seat_number', 'studio_id'],
                ['seat_row', 'seat_number', 'studio_id','updated_at']);
            }
        }
    }
}
