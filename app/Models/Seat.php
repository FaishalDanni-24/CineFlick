<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    protected $fillable = [
        'studio_id',
        'seat_row',
        'seat_number',
    ];

    // Accessor buat gabung seat_row + seat_number jadi "A3", "B5", dll
    public function getSeatNumberAttribute()
    {
        return $this->attributes['seat_row'] . $this->attributes['seat_number'];
    }

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
