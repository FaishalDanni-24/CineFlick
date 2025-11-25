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
    public function booking(){
        return $this->hasMany(Film::class);
    }
    public function studio(){
        return $this->belongsTo(Studio::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function film(){
        return $this->belongsTo(Film::class);
    }
}
