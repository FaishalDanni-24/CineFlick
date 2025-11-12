<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable =[
        'seat_row',
        'seat_number',
        'studio_id'
    ];
    public function studio(){
        return $this->belongsTo(studio::class);
    }
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
