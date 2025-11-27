<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan Total Harga Tiket
                TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),

                // Menampilkan Tanggal Booking
                TextColumn::make('booking_date')
                    ->dateTime()
                    ->sortable(),

                // Menampilkan Status Pembayaran
                TextColumn::make('status')
                    ->badge(),

                // Menampilkan ID User yang memesan
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),

                // Menampilkan ID Jam Tayang
                TextColumn::make('showtime_id')
                    ->numeric()
                    ->sortable(),

                // Waktu data dibuat
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Waktu data terakhir diupdate
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
