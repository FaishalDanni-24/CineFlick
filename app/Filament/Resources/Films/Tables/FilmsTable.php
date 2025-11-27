<?php

namespace App\Filament\Resources\Films\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Film;

class FilmsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // 1. KOLOM TABEL
            ->columns([
                // Menampilkan Judul Film & Bisa dicari
                TextColumn::make('title')
                    ->searchable(),

                // Menampilkan Penerbit
                TextColumn::make('publisher')
                    ->searchable(),

                // Menampilkan Tahun Rilis
                TextColumn::make('released_year'),

                // Menampilkan Genre
                TextColumn::make('genre')
                    ->searchable(),

                // Menampilkan Durasi (Angka) & Bisa diurutkan (Sortable)
                TextColumn::make('duration_mins')
                    ->numeric()
                    ->sortable(),

                // Menampilkan Rating
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),

                // Menampilkan Text Lokasi File Poster
                TextColumn::make('poster_path')
                    ->label('Poster')
                    ->searchable(),
            
                // Menampilkan ID Admin yang menginput
                TextColumn::make('user_id')
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
            //2. FILTER DATA
            ->filters([
                // Filter tabel
                Tables\Filters\SelectFilter::make('genre')
                    ->options(function () {
                        return Film::query()
                            ->select('genre')
                            ->distinct()
                            ->pluck('genre', 'genre')
                            ->toArray();
                    })
                    ->label('Filter by Genre'),

                //Filter Tahun Rilis
                Tables\Filters\SelectFilter::make('released_year')
                    ->options(function () {
                        return Film::query()
                            ->select('released_year')
                            ->distinct()
                            ->orderBy('released_year', 'desc')
                            ->pluck('released_year', 'released_year')
                            ->toArray();
                    })
                    ->label('Filter by Year'),
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
