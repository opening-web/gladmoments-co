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

    public static function slugAliases(string $slug): array
    {
        return match ($slug) {
            'gladtocall' => ['gladtocall', 'glad-to-call'],
            'glad-to-call' => ['glad-to-call', 'gladtocall'],
            default => [$slug],
        };
    }

    public static function whereSlug(string $slug)
    {
        return static::whereIn('slug', static::slugAliases($slug));
    }

    public static function findBySlug(string $slug): ?self
    {
        return static::whereSlug($slug)->first();
    }

    public static function idBySlug(string $slug): ?int
    {
        return static::whereSlug($slug)->value('id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? '/storage/' . ltrim($this->image_path, '/') : null;
    }
}