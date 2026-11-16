<aside class="admin-sidebar" id="adminSidebar">

    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span class="brand-icon">P</span>
            <span class="brand-text">Portfolio<span class="brand-dot">.</span></span>
        </a>
        <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Close sidebar">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="sidebar-admin-info">
        @if(session('admin_avatar'))
            <img src="{{ session('admin_avatar') }}" alt="Admin" class="admin-avatar-img">
        @else
            <div class="admin-avatar-placeholder">
                {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
            </div>
        @endif
        <div class="admin-info-text">
            <span class="admin-name">{{ session('admin_name', 'Admin') }}</span>
            <span class="admin-role">Administrator</span>
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section-label">Main</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.profile.edit') }}"
           class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profile
        </a>

        <a href="{{ route('admin.skills.index') }}"
           class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
            Skills
        </a>

        <a href="{{ route('admin.projects.index') }}"
           class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                <line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
            Projects
        </a>

        <a href="{{ route('admin.experiences.index') }}"
           class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
            </svg>
            Experience
        </a>

        <a href="{{ route('admin.education.index') }}"
           class="nav-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
            Education
        </a>

        <a href="{{ route('admin.services.index') }}"
           class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M19.07 19.07l-1.41-1.41M12 2v2M12 20v2"/>
            </svg>
            Services
        </a>

        <a href="{{ route('admin.social-links.index') }}"
           class="nav-link {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/>
                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
            </svg>
            Social Links
        </a>

        <div class="nav-section-label">Management</div>

        <a href="{{ route('admin.messages.index') }}"
           class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            Messages
            @php $unread = \App\Models\Message::unread()->count(); @endphp
            @if($unread > 0)
                <span class="nav-badge">{{ $unread }}</span>
            @endif
        </a>

        <a href="{{ route('admin.settings.edit') }}"
           class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M19.07 19.07l-1.41-1.41M12 2v2M12 20v2"/>
            </svg>
            Settings
        </a>

    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" target="_blank" class="sidebar-footer-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
            View Portfolio
        </a>
        <form method="POST" action="{{ route('auth.google.logout') }}">
            @csrf
            <button type="submit" class="sidebar-footer-link logout-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>

<!-- Sidebar overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
