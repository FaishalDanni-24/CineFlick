<?php

namespace App\Filament\Resources\BookingFoodDrinks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

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
                    ->numeric()
                    ->prefix('Rp'),
                Select::make('booking_id')
                    ->label('Booking_id')
                    ->relationship('booking', 'id')
                    ->required(),
                Select::make('food_drink_id')
                    ->label('Food/Drink')
                    ->relationship('fooddrink', 'name')
                    ->required(),
            ]);
    }
}
