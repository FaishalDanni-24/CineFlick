<?php

namespace App\Filament\Resources\Seats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeatsTable
{
    // Konfigurasi Tabel Daftar Kursi
    public static function configure(Table $table): Table
    {
        return $table
            // 1. DAFTAR KOLOM
            ->columns([
                // Menampilkan Baris Kursi
                TextColumn::make('seat_row')
                    ->searchable(),

                // Menampilkan Nomor Kursi 
                TextColumn::make('seat_number')
                    ->numeric()
                    ->sortable(),

                // Menampilkan ID Studio
                TextColumn::make('studio_id')
                    ->numeric()
                    ->sortable(),

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
