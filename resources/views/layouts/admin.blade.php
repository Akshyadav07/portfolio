<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Portfolio')) — Admin</title>

    <meta name="description" content="Portfolio Admin Dashboard">

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Base admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <!-- Page-specific CSS -->
    @stack('styles')
</head>
<body>

    <div class="admin-layout" id="adminLayout">

        <!-- SIDEBAR -->
        @include('components.admin-sidebar')

        <!-- MAIN AREA -->
        <div class="admin-main" id="adminMain">

            <!-- TOPBAR -->
            @include('components.admin-topbar')

            <!-- PAGE CONTENT -->
            <main class="admin-content">

                {{-- Flash messages --}}
                @if(session('success'))
                    <div class="flash flash-success" id="flashMsg">
                        <span class="flash-icon">✓</span>
                        <span>{{ session('success') }}</span>
                        <button class="flash-close" onclick="this.parentElement.remove()">×</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="flash flash-error" id="flashMsg">
                        <span class="flash-icon">⚠</span>
                        <span>{{ session('error') }}</span>
                        <button class="flash-close" onclick="this.parentElement.remove()">×</button>
                    </div>
                @endif

                {{-- Page heading --}}
                <div class="page-header">
                    <div>
                        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                        <p class="page-subtitle">@yield('page-subtitle', '')</p>
                    </div>
                    <div class="page-actions">
                        @yield('page-actions')
                    </div>
                </div>

                {{-- Main content --}}
                @yield('content')

            </main>

        </div>

    </div>

    <!-- Admin JS -->
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @stack('scripts')

</body>
</html>
