
@extends('admin.base')

@section('body')

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-logo">
            <h2>Portfolio<span>.</span></h2>
            <button class="close-sidebar" id="closeSidebar">&times;</button>
        </div>

        <div class="profile-info">
            <div class="avatar">YN</div>
            <div>
                <h4>Your Name</h4>
                <p>Administrator</p>
            </div>
        </div>

        <div class="menu-heading">MAIN MENU</div>

        <nav class="sidebar-menu">

            <a href="#" class="menu-link">
                <span>▦</span> Dashboard
            </a>

            <a href='#' class="menu-link">
                <span>◉</span> Profile
            </a>

            <a href="#skills" class="menu-link">
                <span>✧</span> Skills
            </a>

            <a href="#education" class="menu-link">
                <span>▤</span> Education
            </a>

            <a href="#experience" class="menu-link">
                <span>◷</span> Experience
            </a>

            <a href="#projects" class="menu-link">
                <span>▣</span> Projects
            </a>

            <a href="#services" class="menu-link">
                <span>◈</span> Services
            </a>

            <div class="menu-heading">MANAGEMENT</div>

            <a href="#messages" class="menu-link">
                <span>✉</span> Messages
            </a>

            <a href="#settings" class="menu-link">
                <span>⚙</span> Settings
            </a>

        </nav>

        <div class="sidebar-bottom">
            <a href="{{ url('/') }}" target="_blank">↗ View Website</a>
            <a href="#logout">⇥ Logout</a>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">☰</button>

                <div>
                    <h2>@yield('page-heading', 'Dashboard')</h2>
                    <p>@yield('page-description', 'Manage your portfolio')</p>
                </div>
            </div>

            <div class="topbar-right">

                <button class="icon-btn">♧</button>

                <div class="admin-profile">
                    <div class="small-avatar">YN</div>
                    <div>
                        <h4>Your Name</h4>
                        <span>Admin</span>
                    </div>
                </div>

            </div>

        </header>

        <!-- PAGE CONTENT -->
        @yield('content')

    </main>

</div>

@endsection
