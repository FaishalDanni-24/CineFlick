<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        // Memanggil file seeder yang digunakan untuk membuat nilai default/awal
        $this->call([
            // Masukan seeder yang dipanggil
            AdminSeeder::class,
            UserSeeder::class/*,
            StudioSeeder::class,
            FilmSeeder::class,
            ShowtimeSeeder::class,
            SeatSeeder::class*/
        ]);
    }
}
