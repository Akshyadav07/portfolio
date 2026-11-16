<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'short_intro',
        'about_description',
        'profile_image',
        'email',
        'phone',
        'location',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'website_url',
        'resume',
        'is_available',
        'years_of_experience',
        'projects_completed',
        'clients_served',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    /**
     * Get the profile image URL with fallback.
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image && file_exists(storage_path('app/public/' . $this->profile_image))) {
            return asset('storage/' . $this->profile_image);
        }

        return asset('assets/images/default-profile.png');
    }

    /**
     * Get the resume download URL.
     */
    public function getResumeUrlAttribute(): ?string
    {
        if ($this->resume) {
            return asset('storage/' . $this->resume);
        }

        return null;
    }
}
