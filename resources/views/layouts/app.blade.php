<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Developer Portfolio')</title>
    <meta name="description" content="@yield('meta-description', \App\Models\Setting::get('site_description', 'PHP Laravel Developer Portfolio'))">
    <meta name="keywords" content="{{ \App\Models\Setting::get('meta_keywords', 'PHP, Laravel, Developer') }}">

    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">

    <!-- Page-specific CSS -->
    @stack('styles')

    <!-- Responsive always last -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>

    <!-- Custom cursor -->
    <div class="cursor-dot" id="cursorDot"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- Header -->
    @include('components.header')

    <!-- Page content -->
    @yield('content')

    <!-- Footer -->
    @include('components.footer')

    <!-- Core JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/interactions.js') }}"></script>

    @stack('scripts')

</body>
</html>
