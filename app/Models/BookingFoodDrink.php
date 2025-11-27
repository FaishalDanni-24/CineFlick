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

    // Casting Tipe Data
    protected $casts = [
        'subtotal' => 'decimal:2'
    ];

    // Relasi ke Booking (Many to One)
    public function booking(){
        return $this->belongsTo(Booking::class);
    }
    // Relasi ke FoodDrink (Many to One)
    public function foodDrink(){
        return $this->belongsTo(FoodDrink::class);
    }
}
