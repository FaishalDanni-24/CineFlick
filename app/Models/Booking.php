<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'total_price',
        'booking_date',
        'status',
        'user_id',
        'showtime_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function showtime(){
        return $this->belongsTo((Showtime::class));
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
    public function bookingFoodDrink(){
        return $this->hasMany(BookingFoodDrink::class);
    }
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
