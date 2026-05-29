<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Payment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_date',
        'payment_method',
        'payment_proof',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function getPaymentProofUrlAttribute()
    {
        if (! $this->payment_proof) {
            return null;
        }

        return '/storage/' . ltrim($this->payment_proof, '/');
    }
}
