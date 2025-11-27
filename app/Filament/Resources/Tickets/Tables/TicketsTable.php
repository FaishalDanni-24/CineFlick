<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    // Konfigurasi Tabel Daftar Tiket
    public static function configure(Table $table): Table
    {
        return $table
            // 1. DAFTAR KOLOM
            ->columns([
                // Menampilkan Harga Tiket
                TextColumn::make('ticket_price')
                    ->numeric()
                    ->sortable(),

                // Menampilkan ID Booking 
                TextColumn::make('booking.id')
                    ->searchable(),

                 // Menampilkan ID Kursi
                TextColumn::make('seat.id')
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
                //
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
