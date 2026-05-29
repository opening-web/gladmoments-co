<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Highlight extends Model
{
    protected $fillable = [
        'title',
        'category',
        'caption',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if (! $this->image_path) {
            return null;
        }

        return '/storage/' . ltrim($this->image_path, '/');
    }
}

