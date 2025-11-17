<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\FileUpload;
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
                    ->numeric()
                    ->prefix('RP'),
                Select::make('booking_id')
                    ->label('Booking_id')
                    ->relationship('booking', 'id')
                    ->required(),
                Select::make('seat_id')
                    ->label('Seat_id')
                    ->relationship('seat', 'id')
                    ->required(),
                FileUpload::make('qr_code_path')
                    ->label('QR Code')
                    ->directory('qr_code')
                    ->disk('public') // Atribut ini untuk menaruh file di folder storage/app/public
                    ->visibility('public') // Atribut ini untuk mengizinkan public untuk melihat file
                    ->image()
                    ->imagePreviewHeight('150')
                    ->nullable()
                    ->preserveFilenames(),
            ]);
    }
}
