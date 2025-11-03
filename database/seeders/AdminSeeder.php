<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default
        DB::table('users')->updateOrInsert(
            // Kondisi untuk cek apakah admin sudah ada (menggunakan email)
            ['email' => 'admin@cineflick.com'],

            // Nilai yang diupdate atau insert
            [
                'name' => "Administrator",
                'email_verified_at' => now(), // Admin otomatis diverified
                'password' => Hash::make('admin123'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin' // Berikan user role admin
            ]
        );
    }
}
