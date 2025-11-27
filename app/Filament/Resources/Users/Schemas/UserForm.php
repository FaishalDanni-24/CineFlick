<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    // Konfigurasi Form untuk data User
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Input Nama Lengkap
                TextInput::make('name')
                    ->required(),

                // 2. Input Email
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                    
                // 3. Input Password
                TextInput::make('password')
                    ->password()
                    ->required(),

                // 4. Pilihan Role
                Select::make('role')
                    ->options(['admin' => 'Admin', 'customer' => 'Customer'])
                    ->default('customer')
                    ->required(),
            ]);
    }
}
