<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodDrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data default makanan dan minuman CineFlick (untuk testing), beberapa diambil dari wireframe
        DB::table('food_drinks')->upsert([
            [
                'name' => 'Salt Popcorn',
                'type' => 'food',
                'price' => 35000.00,
                'image_path' => 'FoodDrink/popcorn.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Caramel Popcorn',
                'type' => 'food',
                'price' => 45000.00,
                'image_path' => 'FoodDrink/popcorn.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Coffe Latte',
                'type' => 'drink',
                'price' => 25000.00,
                'image_path' => 'FoodDrink/latte.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Matcha Latte',
                'type' => 'drink',
                'price' => 25000.00,
                'image_path' => 'FoodDrink/matcha.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ],['name'],
        ['name', 'type', 'price', 'image_path', 'updated_at']);
    }
}
