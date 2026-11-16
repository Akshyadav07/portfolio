<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'level',
        'icon',
        'color',
        'display_order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'level'      => 'integer',
    ];

    /**
     * Scope: only visible skills.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
