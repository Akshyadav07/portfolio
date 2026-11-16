<header class="header" id="mainHeader">
    <div class="container navbar">
        <a href="{{ route('home') }}" class="logo">
            {{ \App\Models\Setting::get('site_title', 'Portfolio') }}<span>.</span>
        </a>
        <nav>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}#home">Home</a></li>
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ route('home') }}#skills">Skills</a></li>
                <li><a href="{{ route('home') }}#experience">Experience</a></li>
                <li><a href="{{ route('home') }}#projects">Projects</a></li>
                <li><a href="{{ route('home') }}#services">Services</a></li>
                <li><a href="{{ route('home') }}#education">Education</a></li>
                <li><a href="{{ route('home') }}#contact" class="nav-cta">Contact</a></li>
            </ul>
        </nav>
        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <button class="mobile-menu-close" id="mobileMenuClose">&times;</button>
    <nav class="mobile-nav-links">
        <a href="{{ route('home') }}#home"       class="mobile-nav-link">Home</a>
        <a href="{{ route('home') }}#about"      class="mobile-nav-link">About</a>
        <a href="{{ route('home') }}#skills"     class="mobile-nav-link">Skills</a>
        <a href="{{ route('home') }}#experience" class="mobile-nav-link">Experience</a>
        <a href="{{ route('home') }}#projects"   class="mobile-nav-link">Projects</a>
        <a href="{{ route('home') }}#services"   class="mobile-nav-link">Services</a>
        <a href="{{ route('home') }}#education"  class="mobile-nav-link">Education</a>
        <a href="{{ route('home') }}#contact"    class="mobile-nav-link">Contact</a>
    </nav>
</div>
