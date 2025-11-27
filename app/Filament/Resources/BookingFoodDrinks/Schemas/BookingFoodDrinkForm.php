<?php

namespace App\Filament\Resources\BookingFoodDrinks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class BookingFoodDrinkForm
{
    // Method ini berfungsi untuk menyusun komponen-komponen form inputan
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input field untuk memasukkan jumlah (Quantity)
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),

                // 2. Input field untuk memasukkan total harga (Subtotal)
                TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                // 3. Dropdown (Pilihan) untuk memilih ID Booking terkait
                Select::make('booking_id')
                    ->label('Booking_id')
                    ->relationship('booking', 'id')
                    ->required(),

                // 4. Dropdown (Pilihan) untuk memilih jenis Makanan/Minuman
                Select::make('food_drink_id')
                    ->label('Food/Drink')
                    ->relationship('fooddrink', 'name')
                    ->required(),
            ]);
    }
}
