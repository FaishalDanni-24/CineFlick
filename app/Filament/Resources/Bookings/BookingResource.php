<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\Pages\CreateBooking;
use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Filament\Resources\Bookings\Schemas\BookingForm;
use App\Filament\Resources\Bookings\Tables\BookingsTable;
use App\Models\Booking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    // 1. DEFINISI MODEL
    protected static ?string $model = Booking::class;

    // 2. TAMPILAN MENU (SIDEBAR)
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Atribut yang digunakan untuk judul data
    protected static ?string $recordTitleAttribute = 'id';

    // 3. KONFIGURASI FORM
    public static function form(Schema $schema): Schema
    {
        return BookingForm::configure($schema);
    }

    // 4. KONFIGURASI TABEL
    public static function table(Table $table): Table
    {
        return BookingsTable::configure($table);
    }

    // 5. RELASI
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // 6. ROUTING HALAMAN
    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
