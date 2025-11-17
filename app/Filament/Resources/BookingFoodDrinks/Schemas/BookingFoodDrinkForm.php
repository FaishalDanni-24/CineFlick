<?php

namespace App\Filament\Resources\BookingFoodDrinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingFoodDrinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('booking_id')
                    ->required()
                    ->numeric(),
                TextInput::make('food_drink_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
