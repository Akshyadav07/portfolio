<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'technologies',
        'thumbnail',
        'github_url',
        'live_url',
        'is_featured',
        'is_visible',
        'display_order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured'  => 'boolean',
        'is_visible'   => 'boolean',
    ];

    /**
     * Get additional images for this project.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('display_order');
    }

    /**
     * Get the thumbnail URL with fallback.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail && file_exists(storage_path('app/public/' . $this->thumbnail))) {
            return asset('storage/' . $this->thumbnail);
        }

        return asset('assets/images/default-project.png');
    }

    /**
     * Scope: only visible projects.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope: featured projects.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
