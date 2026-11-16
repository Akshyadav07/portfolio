@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back! Here\'s your portfolio overview.')

@section('page-actions')
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Add Project
    </a>
@endsection

@section('content')

    {{-- ---- STATS GRID ---- --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(139,92,246,0.15);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8B5CF6" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['total_projects'] }}</div>
                <div class="stat-label">Total Projects</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(6,182,212,0.15);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#06B6D4" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['total_skills'] }}</div>
                <div class="stat-label">Skills Listed</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245,158,11,0.15);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['total_messages'] }}</div>
                <div class="stat-label">Total Messages</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(239,68,68,0.15);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['unread_messages'] }}</div>
                <div class="stat-label">Unread Messages</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(34,197,94,0.15);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['total_experience'] }}</div>
                <div class="stat-label">Experience Records</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(99,102,241,0.15);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['total_education'] }}</div>
                <div class="stat-label">Education Records</div>
            </div>
        </div>

    </div>

    {{-- ---- BOTTOM GRID: Recent Projects + Messages ---- --}}
    <div class="dashboard-grid">

        {{-- Recent Projects --}}
        <div class="admin-card">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem;">
                <div>
                    <h2 class="card-title" style="margin-bottom:0;">Recent Projects</h2>
                    <p class="card-subtitle" style="margin-bottom:0;">Latest 5 projects</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>

            @if($recentProjects->isEmpty())
                <div class="empty-state" style="padding:2rem;">
                    <p>No projects yet.</p>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm" style="margin-top:0.75rem;">Add First Project</a>
                </div>
            @else
                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Featured</th>
                                <th>Visible</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProjects as $project)
                                <tr>
                                    <td><strong>{{ $project->title }}</strong></td>
                                    <td>
                                        @if($project->is_featured)
                                            <span class="badge badge-purple">Featured</span>
                                        @else
                                            <span class="badge" style="background:rgba(255,255,255,0.05); color:var(--text-muted);">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $project->is_visible ? 'badge-success' : 'badge-warning' }}">
                                            {{ $project->is_visible ? 'Visible' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td class="table-actions">
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Recent Messages --}}
        <div class="admin-card">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem;">
                <div>
                    <h2 class="card-title" style="margin-bottom:0;">Recent Messages</h2>
                    <p class="card-subtitle" style="margin-bottom:0;">Latest contact submissions</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>

            @if($recentMessages->isEmpty())
                <div class="empty-state" style="padding:2rem;">
                    <p>No messages yet.</p>
                </div>
            @else
                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMessages as $message)
                                <tr>
                                    <td>
                                        <strong>{{ $message->name }}</strong>
                                        <div style="font-size:11px; color:var(--text-muted);">{{ $message->email }}</div>
                                    </td>
                                    <td>{{ Str::limit($message->subject ?? 'No subject', 25) }}</td>
                                    <td>
                                        <span class="badge {{ $message->is_read ? 'badge-success' : 'badge-danger' }}">
                                            {{ $message->is_read ? 'Read' : 'Unread' }}
                                        </span>
                                    </td>
                                    <td style="color:var(--text-muted); font-size:var(--font-xs);">
                                        {{ $message->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>

    {{-- ---- QUICK ACTIONS ---- --}}
    <div class="admin-card" style="margin-top:1.5rem;">
        <h2 class="card-title">Quick Actions</h2>
        <p class="card-subtitle">Common admin tasks</p>
        <div style="display:flex; flex-wrap:wrap; gap:0.75rem;">
            <a href="{{ route('admin.profile.edit') }}"        class="btn btn-secondary">Edit Profile</a>
            <a href="{{ route('admin.projects.create') }}"     class="btn btn-secondary">Add Project</a>
            <a href="{{ route('admin.skills.create') }}"       class="btn btn-secondary">Add Skill</a>
            <a href="{{ route('admin.experiences.create') }}"  class="btn btn-secondary">Add Experience</a>
            <a href="{{ route('admin.education.create') }}"    class="btn btn-secondary">Add Education</a>
            <a href="{{ route('admin.services.create') }}"     class="btn btn-secondary">Add Service</a>
            <a href="{{ route('admin.social-links.create') }}" class="btn btn-secondary">Add Social Link</a>
            <a href="{{ route('admin.messages.index') }}"      class="btn btn-secondary">
                View Messages
                @if($stats['unread_messages'] > 0)
                    <span class="nav-badge">{{ $stats['unread_messages'] }}</span>
                @endif
            </a>
            <a href="{{ route('admin.settings.edit') }}"       class="btn btn-secondary">Settings</a>
        </div>
    </div>

@endsection
