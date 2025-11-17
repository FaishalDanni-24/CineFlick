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
                TextInput::make('name')
                    ->required(),
                Select::make('type')
                    ->options(['food' => 'Food', 'drink' => 'Drink'])
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
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
