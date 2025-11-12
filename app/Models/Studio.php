<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// model untuk data Studio
class Studio extends Model
{
    protected $fillable = [
        'studio_name',
        'seat_capacity'
    ];

    public function seat(){
        return $this->hasMany(Seat::class);
    }
    public function showtime(){
        return $this->hasMany(Showtime::class);
    }
}
