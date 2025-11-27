<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    // Konfigurasi Form untuk data detail Tiket Fisik
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Harga Per Tiket
                TextInput::make('ticket_price')
                    ->required()
                    ->numeric()
                    ->prefix('RP'),

                // 2. Relasi ke Booking
                Select::make('booking_id')
                    ->label('Booking_id')
                    ->relationship('booking', 'id')
                    ->required(),

                // 3. Relasi ke Seat
                Select::make('seat_id')
                    ->label('Seat_id')
                    ->relationship('seat', 'id')
                    ->required(),
            ]);
    }
}
