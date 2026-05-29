<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'package_id',
        'package_choice',
        'booking_type',
        'customer_name',
        'customer_email',
        'customer_phone',
        'event_date',
        'event_time',
        'event_name',
        'event_location',
        'status',
        'total_price',
        'down_payment',
        'form_details',
        'notes',
    ];

    protected $casts = [
        'event_date' => 'date',
        'total_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'form_details' => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment(): ?Payment
    {
        return $this->payments()->latest('id')->first();
    }

    public function getTotalPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->attributes['total_price'], 0, ',', '.');
    }

    public function getDownPaymentFormattedAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->attributes['down_payment'], 0, ',', '.');
    }
}