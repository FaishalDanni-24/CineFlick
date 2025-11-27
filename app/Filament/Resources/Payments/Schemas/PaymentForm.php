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
                 // 1. Pilihan Metode Pembayaran
                Select::make('method')
                    ->options(['E-Wallet' => 'E Wallet', 'QRIS' => 'QRIS', 'VA' => 'VA'])
                    ->required(),

                // 2. Input Nominal Pembayaran
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                // 3. Input Tanggal & Waktu Pembayaran
                DateTimePicker::make('payment_date'),

                // 4. Pilihan Status Pembayaran
                Select::make('status')
                    ->options(['pending' => 'Pending', 'success' => 'Success', 'failed' => 'Failed'])
                    ->default('pending')
                    ->required(),
                
                // 5. Relasi ke Booking
                Select::make('booking_id')
                    ->label('Booking_id')
                    ->relationship('booking', 'id')
                    ->required(),
            ]);
    }
}
