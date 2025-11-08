<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data awal studio (2 studio dengan kapasitas sebanyak 40 kursi)
        DB::table('studios')->upsert([
            [
                'studio_name' => 'Studio 1',
                'seat_capacity' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'studio_name' => 'Studio 2',
                'seat_capacity' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['studio_name'], 
        ['studio_name', 'seat_capacity', 'updated_at']);
    }
}
