<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'institution',
        'degree',
        'field_of_study',
        'start_year',
        'end_year',
        'is_current',
        'description',
        'grade',
        'display_order',
        'is_visible',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'is_visible' => 'boolean',
    ];

    /**
     * Get formatted year range.
     */
    public function getYearRangeAttribute(): string
    {
        $end = $this->is_current ? 'Present' : ($this->end_year ?? 'Present');
        return $this->start_year . ' — ' . $end;
    }

    /**
     * Scope: visible only.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
