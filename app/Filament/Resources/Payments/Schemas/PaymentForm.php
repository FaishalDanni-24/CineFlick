<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('method')
                    ->options(['E-Wallet' => 'E Wallet', 'QRIS' => 'QRIS', 'VA' => 'VA'])
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                DateTimePicker::make('payment_date'),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'success' => 'Success', 'failed' => 'Failed'])
                    ->default('pending')
                    ->required(),
                Select::make('booking_id')
                    ->label('Booking_id')
                    ->relationship('booking', 'id')
                    ->required(),
            ]);
    }
}
