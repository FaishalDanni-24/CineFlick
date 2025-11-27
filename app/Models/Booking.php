<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // $fillable berfungsi sebagai keamanan (Mass Assignment Protection)
    protected $fillable = [
        'total_price',
        'booking_date',
        'status',
        'user_id',
        'showtime_id'
    ];
    // Relasi: Booking -> User (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi: Booking -> Showtime (Many to One)
    public function showtime(){
        return $this->belongsTo((Showtime::class));
    }
     // Relasi: Booking -> Payment (One to Many)
    public function payment(){
        return $this->hasMany(Payment::class);
    }
    // Relasi: Booking -> BookingFoodDrink (One to Many)
    public function bookingFoodDrink(){
        return $this->hasMany(BookingFoodDrink::class);
    }
    // Relasi: Booking -> Ticket (One to Many)
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
