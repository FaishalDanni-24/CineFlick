<?php

namespace App\Filament\Resources\BookingFoodDrinks;

use App\Filament\Resources\BookingFoodDrinks\Pages\CreateBookingFoodDrink;
use App\Filament\Resources\BookingFoodDrinks\Pages\EditBookingFoodDrink;
use App\Filament\Resources\BookingFoodDrinks\Pages\ListBookingFoodDrinks;
use App\Filament\Resources\BookingFoodDrinks\Schemas\BookingFoodDrinkForm;
use App\Filament\Resources\BookingFoodDrinks\Tables\BookingFoodDrinksTable;
use App\Models\BookingFoodDrink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookingFoodDrinkResource extends Resource
{
    protected static ?string $model = BookingFoodDrink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return BookingFoodDrinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookingFoodDrinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookingFoodDrinks::route('/'),
            'create' => CreateBookingFoodDrink::route('/create'),
            'edit' => EditBookingFoodDrink::route('/{record}/edit'),
        ];
    }
}
