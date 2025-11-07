<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Buat data user default (untuk testing)
        DB::table('users')->upsert([
            [
                'name' => 'User 1',
                'email' => 'user1@mail.com',
                'email_verified_at' => now(), // User otomatis diverified
                'password' => Hash::make('12345678'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'customer' // Berikan user role customer
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@mail.com',
                'email_verified_at' => now(), // User otomatis diverified
                'password' => Hash::make('12345678'), // Hanya untuk pengembangan saja
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'customer' // Berikan user role customer
            ],
        ],['email'],
        ['name', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at', 'role']);
    }
}
