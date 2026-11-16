<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Profile (single record) ----
        Profile::create([
            'name'               => 'Your Name',
            'designation'        => 'PHP Laravel Developer',
            'short_intro'        => 'I build secure, scalable and dynamic web applications using modern technologies.',
            'about_description'  => 'I am a passionate PHP & Laravel developer focused on building clean, maintainable backend systems. I enjoy turning complex problems into simple, beautiful and intuitive solutions.',
            'email'              => 'your@email.com',
            'phone'              => '+1 (555) 000-0000',
            'location'           => 'Your City, Country',
            'github_url'         => 'https://github.com/yourusername',
            'linkedin_url'       => 'https://linkedin.com/in/yourusername',
            'is_available'       => true,
            'years_of_experience'=> 2,
            'projects_completed' => 10,
            'clients_served'     => 5,
        ]);

        // ---- Default Skills ----
        $skills = [
            ['name' => 'PHP',        'category' => 'Backend',  'level' => 90, 'color' => '#8B5CF6'],
            ['name' => 'Laravel',    'category' => 'Backend',  'level' => 88, 'color' => '#EF4444'],
            ['name' => 'MySQL',      'category' => 'Database', 'level' => 82, 'color' => '#06B6D4'],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'level' => 75, 'color' => '#F59E0B'],
            ['name' => 'HTML5',      'category' => 'Frontend', 'level' => 92, 'color' => '#F97316'],
            ['name' => 'CSS3',       'category' => 'Frontend', 'level' => 85, 'color' => '#3B82F6'],
            ['name' => 'Git',        'category' => 'Tools',    'level' => 78, 'color' => '#22C55E'],
            ['name' => 'REST APIs',  'category' => 'Backend',  'level' => 83, 'color' => '#8B5CF6'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::create(array_merge($skill, ['display_order' => $index + 1]));
        }

        // ---- Default Services ----
        $services = [
            [
                'title'       => 'Backend Development',
                'description' => 'Building secure, scalable and high-performance backend systems using PHP and Laravel.',
                'icon'        => 'server',
                'color'       => '#8B5CF6',
            ],
            [
                'title'       => 'Web Application Development',
                'description' => 'Full-stack web application development with clean MVC architecture and modern UI.',
                'icon'        => 'globe',
                'color'       => '#06B6D4',
            ],
            [
                'title'       => 'REST API Development',
                'description' => 'Designing and building RESTful APIs with proper authentication, versioning and documentation.',
                'icon'        => 'api',
                'color'       => '#F59E0B',
            ],
            [
                'title'       => 'Database Design',
                'description' => 'Efficient relational database design with optimized queries, indexes and Eloquent ORM.',
                'icon'        => 'database',
                'color'       => '#22C55E',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::create(array_merge($service, ['display_order' => $index + 1]));
        }

        // ---- Default Social Links ----
        $socialLinks = [
            ['platform' => 'GitHub',   'url' => 'https://github.com/yourusername',      'color' => '#FFFFFF', 'icon' => 'github'],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/yourusername', 'color' => '#0A66C2', 'icon' => 'linkedin'],
            ['platform' => 'Twitter',  'url' => 'https://twitter.com/yourusername',      'color' => '#1DA1F2', 'icon' => 'twitter'],
        ];

        foreach ($socialLinks as $index => $link) {
            SocialLink::create(array_merge($link, ['display_order' => $index + 1]));
        }

        // ---- Default Settings ----
        $settings = [
            'site_title'       => 'Developer Portfolio',
            'site_description' => 'PHP Laravel Developer — Building scalable web applications.',
            'footer_text'      => '© ' . date('Y') . ' Your Name. All rights reserved.',
            'hero_tagline'     => 'Building the web, one line at a time.',
            'contact_email'    => 'your@email.com',
            'meta_keywords'    => 'PHP, Laravel, Web Developer, Backend Developer',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // ---- Default Admin User ----
        $this->call(AdminUserSeeder::class);
    }
}
