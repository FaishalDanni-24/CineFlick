<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    // Konfigurasi Tabel Daftar Pembayaran
    public static function configure(Table $table): Table
    {
        return $table
            // 1. DAFTAR KOLOM
            ->columns([
                // Menampilkan Metode Pembayaran
                TextColumn::make('method')
                    ->badge(),

                // Menampilkan Jumlah Bayar
                TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),

                // Menampilkan Tanggal Transaksi
                TextColumn::make('payment_date')
                    ->dateTime()
                    ->sortable(),

                // Menampilkan Status
                TextColumn::make('status')
                    ->badge(),

                // Menampilkan ID Booking
                TextColumn::make('booking.id')
                    ->searchable(),

                // Timestamp
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            // 2. FILTER
            ->filters([
                
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
