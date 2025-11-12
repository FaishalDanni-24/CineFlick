<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingFoodDrink extends Model
{
    protected $fillable = [
        'quantity',
        'subtotal',
        'booking_id',
        'food_drink_id'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
    public function foodDrink(){
        return $this->belongsTo(FoodDrink::class);
    }
}
