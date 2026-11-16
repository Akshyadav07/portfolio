<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{Profile, Skill, Project, Experience, Education, Service, SocialLink, Setting};

class HomeController extends Controller
{
    public function index()
    {
        // Single profile record
        $profile = Profile::first();

        // Skills grouped by category, ordered
        $skills = Skill::visible()
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        // Projects visible, ordered
        $projects = Project::visible()
            ->with('images')
            ->orderBy('display_order')
            ->orderByDesc('is_featured')
            ->get();

        // Experience visible, latest first by start_date
        $experiences = Experience::visible()
            ->orderBy('display_order')
            ->orderByDesc('start_date')
            ->get();

        // Education visible, latest first
        $education = Education::visible()
            ->orderBy('display_order')
            ->orderByDesc('start_year')
            ->get();

        // Services visible, ordered
        $services = Service::visible()
            ->orderBy('display_order')
            ->get();

        // Social links visible, ordered
        $socialLinks = SocialLink::visible()
            ->orderBy('display_order')
            ->get();

        // Site settings
        $settings = Setting::getMany([
            'site_title',
            'site_description',
            'footer_text',
            'hero_tagline',
            'contact_email',
            'meta_keywords',
        ]);

        return view('frontend.home', compact(
            'profile',
            'skills',
            'projects',
            'experiences',
            'education',
            'services',
            'socialLinks',
            'settings'
        ));
    }
}
