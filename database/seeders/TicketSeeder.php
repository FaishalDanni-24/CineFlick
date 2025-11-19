<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data default untuk tabel tickets (untuk testing) 
        DB::table('tickets')->upsert([
            [
                'ticket_price' => 35000.00,
                'booking_id' => 1,
                'seat_id' => 26,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_price' => 30000.00,
                'booking_id' => 2,
                'seat_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_price' => 40000.00,
                'booking_id' => 3,
                'seat_id' => 37,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_price' => 40000.00,
                'booking_id' => 3,
                'seat_id' => 38,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ],['booking_id','seat_id'],
        ['ticket_price', 'booking_id', 'seat_id']);
    }
}
