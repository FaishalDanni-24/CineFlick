<?php

namespace App\Filament\Resources\BookingFoodDrinks\Pages;

use App\Filament\Resources\BookingFoodDrinks\BookingFoodDrinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBookingFoodDrink extends EditRecord
{
    protected static string $resource = BookingFoodDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
