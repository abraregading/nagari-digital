<nav class="navbar" id="navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar__logo">
            <i class="fa-solid {{ $settings['logo_icon'] ?? 'fa-leaf' }}"></i>
            <span>Nagari<span class="navbar__logo-accent">Digital</span></span>
        </a>

        <div class="navbar__links">
            <a href="{{ route('home') }}" class="navbar__link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('fitur') }}" class="navbar__link {{ request()->routeIs('fitur') ? 'active' : '' }}">Fitur</a>
            <a href="{{ route('harga') }}" class="navbar__link {{ request()->routeIs('harga') ? 'active' : '' }}">Harga</a>
            <a href="{{ route('tentang') }}" class="navbar__link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
            <a href="{{ route('kontak') }}" class="navbar__link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            <a href="{{ route('demo') }}" class="navbar__link navbar__link--demo {{ request()->routeIs('demo') ? 'active' : '' }}">Demo</a>
        </div>

        <button class="navbar__hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
        <div class="navbar__overlay"></div>
    </div>
</nav>
