<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'icon',
        'badge_label',
        'image_path',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? '/storage/' . ltrim($this->image_path, '/') : null;
    }
}