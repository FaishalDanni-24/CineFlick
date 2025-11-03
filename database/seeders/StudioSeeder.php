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
                'name_studio' => 'Studio 1',
                'capacity' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_studio' => 'Studio 2',
                'capacity' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['name_studio'], 
        ['name_studio', 'capacity', 'updated_at']);
    }
}
