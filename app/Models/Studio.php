<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        'studio_name',
        'seat_capacity',
    ];

    // Nambah accessor buat backward compatibility
    public function getNameAttribute()
    {
        return $this->studio_name;
    }

    public function seat()
    {
        return $this->hasMany(Seat::class);
    }
}
