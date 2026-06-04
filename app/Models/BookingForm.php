<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingForm extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'slug',
        'description',
        'form_type',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(BookingFormField::class)->orderBy('order');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
