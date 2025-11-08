<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data default untuk tabel payments (untuk testing) 
        DB::table('payments')->upsert([
            [
                'method' => 'E-Wallet',
                'amount' => 70000.00,
                'payment_date' => now(),
                'status' => 'pending',
                'booking_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'method' => 'VA',
                'amount' => 100000.00,
                'payment_date' => now(),
                'status' => 'success',
                'booking_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'method' => 'QRIS',
                'amount' => 130000.00,
                'payment_date' => now(),
                'status' => 'failed',
                'booking_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ],['booking_id'],
        ['method', 'amount', 'payment_date', 'status', 'booking_id', 'updated_at']);
    }
}
