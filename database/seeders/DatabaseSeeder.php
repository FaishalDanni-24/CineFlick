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
            // Masukan seeder yang dipanggil (Urutan seeder tabel disesuaikan dengan foreign key yang dibutuhkan)
            AdminSeeder::class,
            UserSeeder::class,
            FoodDrinkSeeder::class,
            StudioSeeder::class,
            FilmSeeder::class,
            SeatSeeder::class,
            ShowtimeSeeder::class,
            BookingSeeder::class,
            BookingFoodDrinkSeeder::class,
            TicketSeeder::class,
            PaymentSeeder::class
        ]);
    }
}
