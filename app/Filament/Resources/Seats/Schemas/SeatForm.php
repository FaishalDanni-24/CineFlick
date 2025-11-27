<?php

namespace App\Filament\Resources\Seats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SeatForm
{
    // Konfigurasi Form untuk menambah/mengedit Kursi Bioskop
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Baris Kursi
                TextInput::make('seat_row')
                    ->required(),

                // 2. Input Nomor Kursi
                TextInput::make('seat_number')
                    ->required()
                    ->numeric(),

                // 3. Pilihan Studio
                Select::make('studio_id')
                    ->label('Studio Name')
                    ->relationship('studio', 'studio_name')
                    ->required(),
            ]);
    }
}
