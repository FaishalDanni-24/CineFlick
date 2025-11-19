<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_price',
        'booking_id',
        'seat_id'
    ];

    protected $casts = [
        'ticket_price' => 'decimal:2', //mengubah ticket_price menjadi angka desimal
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
    public function seat(): BelongsTo{
        return $this->belongsTo(Seat::class);
    }
}
