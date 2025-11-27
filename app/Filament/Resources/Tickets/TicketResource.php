<?php

namespace App\Filament\Resources\Tickets;

use App\Filament\Resources\Tickets\Pages\CreateTicket;
use App\Filament\Resources\Tickets\Pages\EditTicket;
use App\Filament\Resources\Tickets\Pages\ListTickets;
use App\Filament\Resources\Tickets\Schemas\TicketForm;
use App\Filament\Resources\Tickets\Tables\TicketsTable;
use App\Models\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    // 1. KONEKSI MODEL
    protected static ?string $model = Ticket::class;

    // 2. IKON MENU
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 3. PENCARIAN GLOBAL
    protected static ?string $recordTitleAttribute = 'id';

    // 4. KONFIGURASI FORM
    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    // 5. KONFIGURASI TABEL
    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    // 6. RELASI
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // 7. ROUTING HALAMAN
    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }
}
