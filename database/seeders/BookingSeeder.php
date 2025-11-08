<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Buat data default untuk tabel bookings (untuk testing)
         * total_price = jumlah tiket + jumlah makanan/minuman
         */
        DB::table('bookings')->upsert([
            [
                'total_price' => (35000.00+35000.00),
                'booking_date' => now(),
                'status' => 'pending',
                'user_id' => 3,
                'showtime_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'total_price' => (30000.00+45000.00+25000.00),
                'booking_date' => now(),
                'status' => 'paid',
                'user_id' => 4,
                'showtime_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'total_price' => ((40000.00*2)+(25000.00*2)),
                'booking_date' => now(),
                'status' => 'cancelled',
                'user_id' => 3,
                'showtime_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ],['total_price', 'booking_date', 'status', 'user_id', 'showtime_id'],
        ['total_price', 'booking_date', 'status', 'user_id', 'showtime_id', 'updated_at']);
    }
}
