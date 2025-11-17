<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ticket_price')
                    ->required()
                    ->numeric(),
                TextInput::make('qr_code_path'),
                Select::make('booking_id')
                    ->relationship('booking', 'id')
                    ->required(),
                Select::make('seat_id')
                    ->relationship('seat', 'id')
                    ->required(),
            ]);
    }
}
