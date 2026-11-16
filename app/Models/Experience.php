<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company',
        'position',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'responsibilities',
        'company_url',
        'location',
        'display_order',
        'is_visible',
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'is_current'       => 'boolean',
        'is_visible'       => 'boolean',
        'start_date'       => 'date',
        'end_date'         => 'date',
    ];

    /**
     * Get formatted duration string.
     */
    public function getDurationAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end   = $this->is_current ? 'Present' : ($this->end_date ? $this->end_date->format('M Y') : 'Present');
        return $start . ' — ' . $end;
    }

    /**
     * Scope: visible only.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
