<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    protected $fillable = ['title', 'image_path', 'image', 'description', 'category'];

    const UPDATED_AT = null;

    public function getImagePathAttribute($value)
    {
        return $value ?: ($this->attributes['image'] ?? null);
    }

    public function getImageUrlAttribute()
    {
        if (! $this->image_path) {
            return null;
        }

        return '/storage/' . ltrim($this->image_path, '/');
    }
}