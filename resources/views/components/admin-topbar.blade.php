<header class="admin-topbar" id="adminTopbar">

    <div class="topbar-left">
        <button class="topbar-menu-btn" id="sidebarToggleBtn" aria-label="Toggle sidebar">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="topbar-right">

        <!-- View site link -->
        <a href="{{ route('home') }}" target="_blank" class="topbar-action-btn" title="View Portfolio">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
        </a>

        <!-- Admin profile dropdown -->
        <div class="topbar-profile" id="profileDropdown">
            <div class="topbar-profile-trigger" id="profileTrigger">
                @if(session('admin_avatar'))
                    <img src="{{ session('admin_avatar') }}" alt="Admin" class="topbar-avatar-img">
                @else
                    <div class="topbar-avatar-placeholder">
                        {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
                    </div>
                @endif
                <span class="topbar-admin-name">{{ session('admin_name', 'Admin') }}</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>

            <div class="profile-dropdown-menu" id="profileDropdownMenu">
                <div class="dropdown-user-info">
                    <span class="dropdown-name">{{ session('admin_name', 'Admin') }}</span>
                    <span class="dropdown-email">{{ session('admin_email', '') }}</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    Edit Profile
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="dropdown-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M2 12h2M20 12h2"/>
                    </svg>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('auth.google.logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-logout">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>

</header>
