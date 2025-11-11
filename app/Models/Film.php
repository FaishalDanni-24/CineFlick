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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPosterUrlAttribute(): ?string
    {
        return $this->poster_path
            ? asset('storage/' . $this->poster_path)
            : null;
    }
}
