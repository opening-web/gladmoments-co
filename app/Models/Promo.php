<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'caption',
        'image_path',
        'banner_image',
        'cta_text',
        'cta_url',
        'cta_target',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    public function getImageUrlAttribute()
    {
        $path = $this->image_path ?? $this->banner_image;
        if (! $path) {
            return null;
        }

        return '/storage/' . ltrim($path, '/');
    }
}
