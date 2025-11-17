<?php

namespace App\Filament\Resources\FoodDrinks\Pages;

use App\Filament\Resources\FoodDrinks\FoodDrinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFoodDrinks extends ListRecords
{
    protected static string $resource = FoodDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
