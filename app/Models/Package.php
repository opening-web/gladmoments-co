<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['service_id', 'name', 'description', 'price', 'promo_percent'];

    protected $casts = [
        'price' => 'decimal:2',
        'promo_percent' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getDiscountedPriceAttribute()
    {
        if ($this->promo_percent && $this->promo_percent > 0) {
            return round((float) $this->price * (100 - $this->promo_percent) / 100, 2);
        }

        return null;
    }
}
