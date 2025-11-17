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
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                DateTimePicker::make('booking_date')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
                Select::make('user_id')
                    ->label('Booking by (Customer)')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'customer'))
                    ->required(),
                Select::make('showtime_id')
                    ->label('Showtime_id')
                    ->relationship('showtime', 'id')
                    ->required(),
            ]);
    }
}
