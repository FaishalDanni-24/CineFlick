<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $fillable = [
        'show_date',
        'start_time',
        'end_time',
        'normal_price',
        'film_id',
        'studio_id',
        'user_id'
    ];

    // Relasi: Satu Jadwal bisa punya banyak Booking 
    public function booking(){
        return $this->hasMany(Film::class);
    }

    // Relasi: Jadwal ini main di Studio mana
    public function studio(){
        return $this->belongsTo(Studio::class);
    }

    // Relasi: Jadwal ini dibuat oleh Admin siapa
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relasi: Jadwal ini menayangkan Film apa
    public function film(){
        return $this->belongsTo(Film::class);
    }
}
