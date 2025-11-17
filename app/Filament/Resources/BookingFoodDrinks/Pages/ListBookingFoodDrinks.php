<?php

namespace App\Filament\Resources\BookingFoodDrinks\Pages;

use App\Filament\Resources\BookingFoodDrinks\BookingFoodDrinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookingFoodDrinks extends ListRecords
{
    protected static string $resource = BookingFoodDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
