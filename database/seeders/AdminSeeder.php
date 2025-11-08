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
        DB::table('users')->upsert([
            [
                'name' => 'Administrator 1',
                'email' => 'admin1@cineflick.com',
                'email_verified_at' => now(), // User otomatis diverified
                'password' => Hash::make('admin123'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin', // Berikan user role admin
                'gender' => 'laki-laki'
            ],
            [
                'name' => 'Administrator 2',
                'email' => 'admin2@cineflick.com',
                'email_verified_at' => now(), // User otomatis diverified
                'password' => Hash::make('admin123'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin', // Berikan user role admin
                'gender' => 'perempuan'
            ],
        ],['email'],
        ['name', 'email', 'password', 'remember_token', 'updated_at', 'role', 'gender']);
    }
}
