<?php

namespace App\Filament\Resources\FoodDrinks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FoodDrinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Nama Makanan/Minuman
                TextInput::make('name')
                    ->required(),

                // 2. Pilihan Tipe
                Select::make('type')
                    ->options(['food' => 'Food', 'drink' => 'Drink'])
                    ->required(),

                // 3. Input Harga
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                // 4. Upload Gambar Makanan/Minuman
                FileUpload::make('image_path')
                    ->label('Image')
                    ->directory('FoodDrink')
                    ->disk('public') // Atribut ini untuk menaruh file di folder storage/app/public
                    ->visibility('public') // Atribut ini untuk mengizinkan public untuk melihat file
                    ->image()
                    ->imagePreviewHeight('150')
                    ->nullable()
                    ->preserveFilenames(),
            ]);
    }
}
