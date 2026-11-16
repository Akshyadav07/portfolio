@extends('layouts.app')

@section('title', ($settings['site_title'] ?? 'Developer') . ' | Portfolio')
@section('meta-description', $profile?->about_description ?? '')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush

@section('content')

{{-- HERO SECTION --}}
<section id="home" class="hero section">
    <!-- Animated background -->
    <div class="hero-bg">
        <div class="hero-bg-grid"></div>
        <div class="hero-bg-glow glow-1"></div>
        <div class="hero-bg-glow glow-2"></div>
    </div>

    <div class="container hero-container">
        <div class="hero-text">
            <div class="hero-badge reveal">
                <span class="badge-dot"></span>
                {{ $profile?->is_available ? 'Available for hire' : 'Currently unavailable' }}
            </div>

            <h1 class="hero-title reveal delay-1">
                Hello, I'm<br>
                <span class="text-gradient">{{ $profile?->name ?? 'Your Name' }}</span>
            </h1>

            @php
                $roles = [$profile?->designation ?? 'Laravel Developer', 'PHP Developer', 'Backend Developer', 'Web Developer'];
            @endphp
            <h2 class="hero-subtitle reveal delay-2">
                <span id="typingText" data-words="{{ json_encode($roles) }}"></span>
                <span class="typing-cursor">|</span>
            </h2>

            <p class="hero-desc reveal delay-3">
                {{ $profile?->short_intro ?? 'Building secure, scalable and dynamic web applications.' }}
            </p>

            <!-- Hero stats -->
            <div class="hero-stats reveal delay-4">
                <div class="hero-stat">
                    <span class="stat-number" data-count="{{ $profile?->years_of_experience ?? 0 }}">0</span>
                    <span class="stat-label">Years Exp.</span>
                </div>
                <div class="stat-divider"></div>
                <div class="hero-stat">
                    <span class="stat-number" data-count="{{ $profile?->projects_completed ?? 0 }}">0</span>
                    <span class="stat-label">Projects</span>
                </div>
                <div class="stat-divider"></div>
                <div class="hero-stat">
                    <span class="stat-number" data-count="{{ $profile?->clients_served ?? 0 }}">0</span>
                    <span class="stat-label">Clients</span>
                </div>
            </div>

            <div class="hero-actions reveal delay-5">
                <a href="#projects" class="btn-primary">View Projects</a>
                @if($profile?->resume_url)
                    <a href="{{ $profile->resume_url }}" class="btn-outline" download>Download Resume</a>
                @endif
                <a href="#contact" class="btn-outline">Contact Me</a>
            </div>

            <!-- Social Links -->
            @if(isset($socialLinks) && $socialLinks->isNotEmpty())
            <div class="hero-socials reveal delay-5">
                @foreach($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="social-icon-link" title="{{ $link->platform }}">
                    @if(strtolower($link->platform) === 'github')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                    @elseif(strtolower($link->platform) === 'linkedin')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    @elseif(strtolower($link->platform) === 'twitter' || strtolower($link->platform) === 'x')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    @endif
                </a>
                @endforeach
            </div>
            @endif
        </div>

        <div class="hero-visual">
            <div class="hero-image-wrapper" data-parallax="10">
                @if($profile?->profile_image)
                    <img src="{{ $profile->profile_image_url }}" alt="{{ $profile->name }}" class="hero-profile-img" loading="eager">
                @else
                    <div class="hero-profile-placeholder">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                @endif
                <div class="profile-ring ring-1"></div>
                <div class="profile-ring ring-2"></div>
            </div>

            <!-- Floating 3D objects -->
            <div class="hero-floating-obj obj-1" data-parallax="15">
                <div class="float-code">&lt;/&gt;</div>
            </div>
            <div class="hero-floating-obj obj-2" data-parallax="25">
                <div class="float-icon">⚡</div>
            </div>
            <div class="hero-floating-obj obj-3" data-parallax="20">
                <div class="float-code">{}</div>
            </div>
            <div class="hero-floating-obj obj-4" data-parallax="18">
                <div class="float-icon">🚀</div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <a href="#about" class="scroll-indicator" aria-label="Scroll down">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <span>Scroll down</span>
    </a>
</section>

{{-- ABOUT SECTION --}}
<section id="about" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Get to know me</span>
            <h2 class="section-title">About <span>Me</span></h2>
        </div>
        <div class="about-grid">
            <div class="about-image-side reveal-left">
                <div class="about-image-wrapper">
                    @if($profile?->profile_image)
                        <img src="{{ $profile->profile_image_url }}" alt="{{ $profile->name }}" class="about-img" loading="lazy">
                    @else
                        <div class="about-img-placeholder"></div>
                    @endif
                    <div class="about-image-decoration"></div>
                    @if($profile?->is_available)
                    <div class="available-badge">
                        <span class="available-dot"></span> Available for work
                    </div>
                    @endif
                </div>
            </div>
            <div class="about-text-side reveal-right">
                <h3 class="about-heading">I'm a {{ $profile?->designation ?? 'PHP Laravel Developer' }}</h3>
                <p class="about-desc">{{ $profile?->about_description ?? 'Passionate about building clean, maintainable backend systems.' }}</p>
                
                <div class="about-info-grid">
                    @if($profile?->email)
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $profile->email }}</span>
                    </div>
                    @endif
                    @if($profile?->phone)
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $profile->phone }}</span>
                    </div>
                    @endif
                    @if($profile?->location)
                    <div class="info-item">
                        <span class="info-label">Location</span>
                        <span class="info-value">{{ $profile->location }}</span>
                    </div>
                    @endif
                </div>

                <div class="about-actions">
                    @if($profile?->resume_url)
                        <a href="{{ $profile->resume_url }}" class="btn-primary" download>Download Resume</a>
                    @endif
                    <a href="#contact" class="btn-outline">Let's Talk</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SKILLS SECTION --}}
<section id="skills" class="section skills-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">My Expertise</span>
            <h2 class="section-title">Technical <span>Skills</span></h2>
        </div>
        @if(!isset($skills) || $skills->isEmpty())
            <p style="text-align: center; color: var(--text-secondary);">Skills coming soon.</p>
        @else
            @foreach($skills as $category => $categorySkills)
            <div class="skill-category reveal">
                <h3 class="skill-category-title">{{ $category }}</h3>
                <div class="skills-grid">
                    @foreach($categorySkills as $skill)
                    <div class="skill-card">
                        <div class="skill-card-inner">
                            <div class="skill-icon-wrapper" style="background: {{ $skill->color ? $skill->color.'1a' : 'rgba(139,92,246,0.1)' }}; border-color: {{ $skill->color ?? 'var(--accent)' }}40;">
                                <span class="skill-icon-letter" style="color: {{ $skill->color ?? 'var(--accent)' }};">
                                    {{ strtoupper(substr($skill->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="skill-info">
                                <h4 class="skill-name">{{ $skill->name }}</h4>
                                <div class="skill-level-wrap">
                                    <div class="skill-bar">
                                        <div class="skill-bar-fill" data-level="{{ $skill->level }}" style="width: 0%; background: linear-gradient(90deg, {{ $skill->color ?? 'var(--accent)' }}, {{ $skill->color ?? 'var(--accent-2)' }});"></div>
                                    </div>
                                    <span class="skill-percent">{{ $skill->level }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>

{{-- EXPERIENCE SECTION --}}
<section id="experience" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">My Journey</span>
            <h2 class="section-title">Work <span>Experience</span></h2>
        </div>
        @if(!isset($experiences) || $experiences->isEmpty())
            <p style="text-align: center; color: var(--text-secondary);">No experience records yet.</p>
        @else
        <div class="timeline">
            @foreach($experiences as $exp)
            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-card glass-card">
                    <div class="timeline-header">
                        <div>
                            <h3 class="timeline-title">{{ $exp->position }}</h3>
                            <p class="timeline-company">{{ $exp->company }}</p>
                        </div>
                        <div class="timeline-meta">
                            <span class="timeline-duration">{{ $exp->duration }}</span>
                            @if($exp->employment_type)
                                <span class="tag">{{ $exp->employment_type }}</span>
                            @endif
                        </div>
                    </div>
                    @if($exp->description)
                        <p class="timeline-desc">{{ $exp->description }}</p>
                    @endif
                    @if($exp->responsibilities && count($exp->responsibilities) > 0)
                    <ul class="responsibility-list">
                        @foreach($exp->responsibilities as $resp)
                            <li>{{ $resp }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if($exp->location)
                        <span class="timeline-location">📍 {{ $exp->location }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- PROJECTS SECTION --}}
<section id="projects" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">My Recent Work</span>
            <h2 class="section-title">My <span>Projects</span></h2>
        </div>
        @if(!isset($projects) || $projects->isEmpty())
            <p style="text-align: center; color: var(--text-secondary);">Projects coming soon.</p>
        @else
        <div class="projects-grid">
            @foreach($projects as $project)
            <div class="project-card glass-card gradient-border reveal-scale">
                <div class="project-thumbnail">
                    <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" loading="lazy" class="project-img">
                    @if($project->is_featured)
                        <span class="project-featured-badge">Featured</span>
                    @endif
                    <div class="project-overlay">
                        <div class="project-overlay-links">
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="overlay-link">GitHub</a>
                            @endif
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="overlay-link overlay-live">Live Demo</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="project-body">
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-desc">{{ $project->short_description ?? Str::limit($project->description, 120) }}</p>
                    @if($project->technologies)
                    <div class="project-tags">
                        @foreach($project->technologies as $tech)
                            <span class="tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="project-links">
                        <a href="{{ route('projects.show', $project->slug) }}" class="project-detail-link">
                            View Details &rarr;
                        </a>
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="project-link-icon" title="GitHub">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                            </a>
                        @endif
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="project-link-icon" title="Live Demo">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- SERVICES SECTION --}}
<section id="services" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">What I Offer</span>
            <h2 class="section-title">My <span>Services</span></h2>
        </div>
        @if(!isset($services) || $services->isEmpty())
            <p style="text-align: center; color: var(--text-secondary);">Services coming soon.</p>
        @else
        <div class="services-grid">
            @foreach($services as $index => $service)
            <div class="service-card glass-card gradient-border reveal delay-{{ ($index % 4) + 1 }}">
                <div class="service-icon-wrap" style="background: {{ $service->color ? $service->color.'1a' : 'rgba(139,92,246,0.1)' }};">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="{{ $service->color ?? 'var(--accent)' }}" stroke-width="1.5">
                        @if($service->icon === 'server')
                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/>
                        @elseif($service->icon === 'globe')
                            <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        @elseif($service->icon === 'database')
                            <ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                        @elseif($service->icon === 'api')
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                        @else
                            <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M19.07 19.07l-1.41-1.41M12 2v2M12 20v2"/>
                        @endif
                    </svg>
                </div>
                <h3 class="service-title">{{ $service->title }}</h3>
                <p class="service-desc">{{ $service->description }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- EDUCATION SECTION --}}
<section id="education" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">My Qualifications</span>
            <h2 class="section-title">My <span>Education</span></h2>
        </div>
        @if(!isset($education) || $education->isEmpty())
            <p style="text-align: center; color: var(--text-secondary);">Education records coming soon.</p>
        @else
        <div class="timeline">
            @foreach($education as $edu)
            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-card glass-card">
                    <div class="timeline-header">
                        <div>
                            <h3 class="timeline-title">{{ $edu->degree }}</h3>
                            <p class="timeline-company">{{ $edu->institution }}</p>
                            @if($edu->field_of_study)
                                <p class="timeline-field">{{ $edu->field_of_study }}</p>
                            @endif
                        </div>
                        <div class="timeline-meta">
                            <span class="timeline-duration">{{ $edu->year_range }}</span>
                            @if($edu->grade)
                                <span class="tag">Grade: {{ $edu->grade }}</span>
                            @endif
                        </div>
                    </div>
                    @if($edu->description)
                        <p class="timeline-desc">{{ $edu->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- CONTACT SECTION --}}
<section id="contact" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Get in Touch</span>
            <h2 class="section-title">Contact <span>Me</span></h2>
        </div>

        @if(session('contact_success'))
        <div id="contactSuccessAlert" class="contact-alert alert-success" style="display:flex;">
            <span>✓</span> {{ session('contact_success') }}
        </div>
        @endif

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info reveal-left">
                <h3>Let's work together</h3>
                <p>Have a project in mind? Let's discuss it. Feel free to reach out through the form or directly via email.</p>

                <div class="contact-details">
                    @if($profile?->email)
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <span class="detail-label">Email</span>
                            <a href="mailto:{{ $profile->email }}" class="detail-value">{{ $profile->email }}</a>
                        </div>
                    </div>
                    @endif
                    @if($profile?->phone)
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.61 4.4 2 2 0 0 1 3.59 2.21h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.09 6.09l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <span class="detail-label">Phone</span>
                            <a href="tel:{{ $profile->phone }}" class="detail-value">{{ $profile->phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($profile?->location)
                    <div class="contact-detail-item">
                        <div class="detail-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <span class="detail-label">Location</span>
                            <span class="detail-value">{{ $profile->location }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrap reveal-right">
                <div id="contactSuccess" class="contact-alert alert-success" style="display:none;">
                    <span>✓</span> Message sent successfully! I'll get back to you soon.
                </div>
                <div id="contactError" class="contact-alert alert-error" style="display:none;">
                    <span>⚠</span> Something went wrong. Please try again.
                </div>

                <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="contact-form glass-card">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Your Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input" placeholder="John Doe" value="{{ old('name') }}" required>
                            <span class="field-error" data-field-error="name">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Your Email <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input" placeholder="john@example.com" value="{{ old('email') }}" required>
                            <span class="field-error" data-field-error="email">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-input" placeholder="Project inquiry" value="{{ old('subject') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message <span class="required">*</span></label>
                        <textarea name="message" class="form-input form-textarea" rows="6" placeholder="Tell me about your project..." required>{{ old('message') }}</textarea>
                        <span class="field-error" data-field-error="message">{{ $errors->first('message') }}</span>
                    </div>
                    <button type="submit" class="btn-primary contact-submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Back to top button --}}
<button id="backToTop" class="back-to-top" aria-label="Back to top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</button>
@endsection
