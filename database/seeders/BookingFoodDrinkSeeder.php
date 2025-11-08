<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingFoodDrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data default untuk tabel booking_food_drinks (untuk testing) 
        DB::table('booking_food_drinks')->upsert([
            [
                'quantity' => 1,
                'subtotal' => 35000.00,
                'booking_id' => 1,
                'food_drink_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'quantity' => 1,
                'subtotal' => 45000.00,
                'booking_id' => 2,
                'food_drink_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'quantity' => 1,
                'subtotal' => 25000.00,
                'booking_id' => 2,
                'food_drink_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'quantity' => 2,
                'subtotal' => 50000.00,
                'booking_id' => 3,
                'food_drink_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ],['booking_id', 'food_drink_id'],
        ['quantity', 'subtotal', 'booking_id', 'food_drink_id', 'updated_at']);
    }
}
