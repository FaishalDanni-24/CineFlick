<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    // Identitas Kursi
    protected $fillable =[
        'seat_row',
        'seat_number',
        'studio_id'
    ];

    // Relasi: Kursi ini ada di dalam satu Studio
    public function studio(){
        return $this->belongsTo(Studio::class);
    }

    // Relasi: Kursi ini bisa punya banyak riwayat Tiket
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
