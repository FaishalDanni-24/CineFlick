<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\type;

class FoodDrink extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'image_path' 
    ];
    protected $casts = [
        'price' => 'decimal:2'
    ];
    
    public function bookingFoodDrink(){
        return $this->hasMany(BookingFoodDrink::class);
    }
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }
}
