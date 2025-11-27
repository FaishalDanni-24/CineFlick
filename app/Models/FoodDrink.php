<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\type;

class FoodDrink extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'image_path' 
    ];

    // Pastikan harga selalu dianggap Decimal 
    protected $casts = [
        'price' => 'decimal:2'
    ];
    
    // Relasi: Menu ini bisa dipesan di banyak transaksi
    public function bookingFoodDrink(){
        return $this->hasMany(BookingFoodDrink::class);
    }
    
    // Accessor: Bikin URL gambar otomatis buat Frontend
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }
}
