<?php

namespace App\Filament\Resources\Studios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudioForm
{
    // Konfigurasi Form untuk menambah/mengedit Studio Bioskop
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Nama Studio
                TextInput::make('studio_name')
                    ->required(),
                
                // 2. Input Kapasitas Kursi
                TextInput::make('seat_capacity')
                    ->required()
                    ->numeric(),
            ]);
    }
}
