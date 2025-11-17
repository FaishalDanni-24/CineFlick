<?php

namespace App\Filament\Resources\Showtimes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ShowtimeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('show_date')
                    ->required(),
                TimePicker::make('start_time')
                    ->required(),
                TimePicker::make('end_time')
                    ->required(),
                TextInput::make('normal_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Select::make('film_id')
                    ->label('Film')
                    ->relationship('film', 'title')
                    ->required(),
                Select::make('studio_id')
                    ->label('Studio Name')
                    ->relationship('studio', 'studio_name')
                    ->required(),
                Select::make('user_id')
                    ->label('Created by (Admin)')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'admin'))
                    ->required(),
            ]);
    }
}
