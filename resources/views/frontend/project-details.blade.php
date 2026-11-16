@extends('layouts.app')

@section('title', $project->title . ' — Project Details')
@section('meta-description', $project->short_description ?? Str::limit($project->description, 160))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/projects.css') }}">
@endpush

@section('content')
<div class="project-details-page section">
    <div class="container">
        <div class="back-nav reveal">
            <a href="{{ route('home') }}#projects" class="back-link">
                &larr; Back to all projects
            </a>
        </div>

        <header class="project-header reveal delay-1">
            <div class="project-meta-top">
                @if($project->is_featured)
                    <span class="tag tag-featured">Featured Project</span>
                @endif
                <span class="project-date">{{ $project->created_at->format('M Y') }}</span>
            </div>
            <h1 class="project-main-title">{{ $project->title }}</h1>
            @if($project->short_description)
                <p class="project-lead">{{ $project->short_description }}</p>
            @endif

            <div class="project-actions-bar">
                @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="btn-primary">
                        Live Preview &nearr;
                    </a>
                @endif
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="btn-outline">
                        GitHub Repository &nearr;
                    </a>
                @endif
            </div>
        </header>

        <div class="project-media-showcase reveal delay-2">
            <div class="main-thumbnail-wrap glass-card">
                <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="main-thumbnail-img">
            </div>

            @if($project->images && $project->images->count() > 0)
                <div class="gallery-grid">
                    @foreach($project->images as $img)
                        <div class="gallery-item glass-card">
                            <img src="{{ $img->image_url }}" alt="{{ $img->alt_text ?? $project->title }}" loading="lazy">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="project-info-grid reveal delay-3">
            <div class="project-description-content glass-card">
                <h2>Project Overview</h2>
                <div class="prose-content">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>

            <aside class="project-sidebar">
                <div class="sidebar-card glass-card">
                    <h3>Technologies Used</h3>
                    <div class="tech-pill-list">
                        @if($project->technologies)
                            @foreach($project->technologies as $tech)
                                <span class="tag">{{ $tech }}</span>
                            @endforeach
                        @else
                            <p class="text-muted">Not specified</p>
                        @endif
                    </div>
                </div>

                @if($project->live_url || $project->github_url)
                <div class="sidebar-card glass-card">
                    <h3>Links</h3>
                    <ul class="link-list">
                        @if($project->live_url)
                            <li>
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener">
                                    Website URL &rarr;
                                </a>
                            </li>
                        @endif
                        @if($project->github_url)
                            <li>
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener">
                                    Source Code (GitHub) &rarr;
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                @endif
            </aside>
        </div>

        @if(isset($relatedProjects) && $relatedProjects->count() > 0)
            <div class="related-section reveal delay-4">
                <h2 class="section-title">Other <span>Projects</span></h2>
                <div class="projects-grid">
                    @foreach($relatedProjects as $rel)
                        <div class="project-card glass-card gradient-border">
                            <div class="project-thumbnail">
                                <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" loading="lazy" class="project-img">
                            </div>
                            <div class="project-body">
                                <h3 class="project-title">{{ $rel->title }}</h3>
                                <p class="project-desc">{{ $rel->short_description ?? Str::limit($rel->description, 90) }}</p>
                                <a href="{{ route('projects.show', $rel->slug) }}" class="project-detail-link">
                                    View Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
