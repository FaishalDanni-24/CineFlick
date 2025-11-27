<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // Data Film
    protected $fillable = [
        'title',
        'publisher',
        'released_year',
        'genre',
        'duration_mins',
        'sinopsis',
        'rating',
        'poster_path',
        'user_id',
    ];

    // Relasi: Film -> User (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi: Film -> Showtime (One to Many)
    public function showtime(){
        return $this->hasMany(Showtime::class);
    }

    // Mengubah path mentah database jadi URL lengkap siap pakai di Frontend
    public function getPosterUrlAttribute(): ?string
    {
        return $this->poster_path
            ? asset('storage/' . $this->poster_path)
            : null;
    }
}
