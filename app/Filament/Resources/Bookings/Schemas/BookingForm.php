<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Total Harga
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                // 2. Input Tanggal & Jam Booking
                DateTimePicker::make('booking_date')
                    ->required(),

                // 3. Pilihan Status Pembayaran
                Select::make('status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
                    
                // 4. Pilihan User
                Select::make('user_id')
                    ->label('Booking by (Customer)')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'customer'))
                    ->required(),

                // 5. Pilihan Jam Tayang
                Select::make('showtime_id')
                    ->label('Showtime_id')
                    ->relationship('showtime', 'id')
                    ->required(),
            ]);
    }
}
