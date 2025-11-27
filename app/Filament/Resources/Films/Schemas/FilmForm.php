<?php

namespace App\Filament\Resources\Films\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Schema;

class FilmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Judul Film
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                // 2. Input Penerbit/Studio
                TextInput::make('publisher')
                    ->required()
                    ->maxLength(255),
                    
                // 3. Input Tahun Rilis
                TextInput::make('released_year')
                    ->required(),

                // 4. Input Genre
                TextInput::make('genre')
                    ->required()
                    ->maxLength(255),

                // 5. Input Durasi (dalam menit)
                TextInput::make('duration_mins')
                    ->required()
                    ->numeric(),

                // 6. Input Sinopsis (Textarea)
                Textarea::make('sinopsis')
                    ->required()
                    ->columnSpanFull(),

                // 7. Input Rating
                TextInput::make('rating')
                    ->required()
                    ->step(0.1)
                    ->minValue(0)
                    ->maxValue(10)
                    ->numeric(),

                // 8. Upload Poster Film
                FileUpload::make('poster_path')
                    ->label('Poster')
                    ->directory('poster')
                    ->disk('public') // Atribut ini untuk menaruh file di folder storage/app/public
                    ->visibility('public') // Atribut ini untuk mengizinkan public untuk melihat file
                    ->image()
                    ->imagePreviewHeight('150')
                    ->nullable()
                    ->preserveFilenames(),

                // 9. Input Created By
                Select::make('user_id')
                    ->label('Created By (Admin)')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'admin'))
                    ->required(),
            ]);
    }
}
