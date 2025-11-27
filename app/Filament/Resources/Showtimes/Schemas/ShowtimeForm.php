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
    // Konfigurasi Form untuk menambah/mengedit Jadwal Tayang
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Tanggal Tayang
                DatePicker::make('show_date')
                    ->required(),

                // 2. Input Jam Mulai
                TimePicker::make('start_time')
                    ->required(),

                 // 3. Input Jam Selesai
                TimePicker::make('end_time')
                    ->required(),

                // 4. Input Harga Tiket Normal
                TextInput::make('normal_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                // 5. Pilih Film
                Select::make('film_id')
                    ->label('Film')
                    ->relationship('film', 'title')
                    ->required(),

                // 6. Pilih Studio
                Select::make('studio_id')
                    ->label('Studio Name')
                    ->relationship('studio', 'studio_name')
                    ->required(),

                // 7. Pilih Admin Pembuat
                Select::make('user_id')
                    ->label('Created by (Admin)')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'admin'))
                    ->required(),
            ]);
    }
}
