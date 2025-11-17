<?php

namespace App\Filament\Resources\Studios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('studio_name')
                    ->required(),
                TextInput::make('seat_capacity')
                    ->required()
                    ->numeric(),
            ]);
    }
}
