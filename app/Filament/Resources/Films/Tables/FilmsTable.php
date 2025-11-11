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
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('publisher')
                    ->searchable(),
                TextColumn::make('released_year'),
                TextColumn::make('genre')
                    ->searchable(),
                TextColumn::make('duration_mins')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('poster_path')
                    ->label('Poster')
                    ->searchable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
