<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Logging\OpenTestReporting\Status;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'method',
        'amount',
        'payment_date',
        'status',
        'booking_id'
    ];
    protected $casts = [
        'payment_date' => 'datetime', //otomatis menjadi objek datetime
        'amount' => 'decimal:2'
    ];
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
