<?php

namespace App\Filament\Resources\FoodDrinks;

use App\Filament\Resources\FoodDrinks\Pages\CreateFoodDrink;
use App\Filament\Resources\FoodDrinks\Pages\EditFoodDrink;
use App\Filament\Resources\FoodDrinks\Pages\ListFoodDrinks;
use App\Filament\Resources\FoodDrinks\Schemas\FoodDrinkForm;
use App\Filament\Resources\FoodDrinks\Tables\FoodDrinksTable;
use App\Models\FoodDrink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FoodDrinkResource extends Resource
{
    protected static ?string $model = FoodDrink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FoodDrinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FoodDrinksTable::configure($table);
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
            'index' => ListFoodDrinks::route('/'),
            'create' => CreateFoodDrink::route('/create'),
            'edit' => EditFoodDrink::route('/{record}/edit'),
        ];
    }
}
