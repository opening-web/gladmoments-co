<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'service_id', 
        'date', 
        'time', 
        'location', 
        'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}