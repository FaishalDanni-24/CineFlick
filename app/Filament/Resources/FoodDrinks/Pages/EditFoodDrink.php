<?php

namespace App\Filament\Resources\FoodDrinks\Pages;

use App\Filament\Resources\FoodDrinks\FoodDrinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFoodDrink extends EditRecord
{
    protected static string $resource = FoodDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
