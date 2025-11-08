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
                'email' => 'admin1@mail.com',
                'email_verified_at' => now(), // User otomatis diverified
                'password' => Hash::make('admin123'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'customer', // Berikan user role customer
                'gender' => 'laki-laki'
            ],
            [
                'name' => 'Administrator 2',
                'email' => 'admin2@mail.com',
                'email_verified_at' => now(), // User otomatis diverified
                'password' => Hash::make('admin123'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'customer', // Berikan user role customer
                'gender' => 'perempuan'
            ],
        ],['email'],
        []);
    }
}
