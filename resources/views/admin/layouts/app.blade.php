<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') — Admin {{ $settings['site_name'] ?? 'Nagari Digital' }}</title>
  @include('admin.layouts.partials.head')
</head>
<body>
  <div class="admin-layout">
    <aside class="sidebar">
      <div class="sidebar__header">
        <div class="sidebar__logo-icon"><i class="fa-solid {{ $settings['logo_icon'] ?? 'fa-leaf' }}"></i></div>
        <span class="sidebar__logo-text">{{ $settings['site_name'] ?? 'Nagari' }}<span class="sidebar__logo-accent">Digital</span></span>
      </div>
      <nav class="sidebar__nav" id="sidebarNav">
        @php
        $currentRoute = request()->route() ? request()->route()->getName() : '';
        $sidebarLinks = [
            'Utama' => [
                ['route' => 'admin.home', 'icon' => 'fa-chart-pie', 'label' => 'Dashboard'],
            ],
            'Konten Website' => [
                ['route' => 'admin.settings.index', 'icon' => 'fa-house', 'label' => 'Homepage'],
                ['route' => 'admin.stats.index', 'icon' => 'fa-chart-simple', 'label' => 'Statistik'],
                ['route' => 'admin.products.index', 'icon' => 'fa-cube', 'label' => 'Produk / Aplikasi'],
                ['route' => 'admin.testimonials.index', 'icon' => 'fa-star', 'label' => 'Testimonial'],
                ['route' => 'admin.pricing-plans.index', 'icon' => 'fa-tags', 'label' => 'Harga & Paket'],
                ['route' => 'admin.faqs.index', 'icon' => 'fa-circle-question', 'label' => 'FAQ'],
                ['route' => 'admin.about-sections.index', 'icon' => 'fa-building-columns', 'label' => 'Tentang Kami'],
            ],
            'Lainnya' => [
                ['route' => 'admin.messages.index', 'icon' => 'fa-envelope', 'label' => 'Pesan Masuk'],
                ['route' => 'route_to_home', 'icon' => 'fa-arrow-left', 'label' => 'Ke Website', 'external' => route('home')],
            ],
        ];
        @endphp
        @foreach($sidebarLinks as $sectionTitle => $links)
        <div class="sidebar__section">
          <div class="sidebar__section-title">{{ $sectionTitle }}</div>
          @foreach($links as $link)
            @php $isActive = $currentRoute === $link['route']; @endphp
            @if(!empty($link['external']))
            <a href="{{ $link['external'] }}" target="_blank" class="sidebar__link">
              <i class="fa-solid {{ $link['icon'] }}"></i><span>{{ $link['label'] }}</span>
            </a>
            @else
            <a href="{{ route($link['route']) }}" class="sidebar__link {{ $isActive ? 'active' : '' }}">
              <i class="fa-solid {{ $link['icon'] }}"></i><span>{{ $link['label'] }}</span>
            </a>
            @endif
          @endforeach
        </div>
        @endforeach
      </nav>
      <div class="sidebar__footer">
        <div class="sidebar__user">
          <div class="sidebar__user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}</div>
          <div class="sidebar__user-info">
            <div class="sidebar__user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
            <div class="sidebar__user-role">Super Admin</div>
          </div>
          <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn--ghost btn--sm" title="Logout" style="color:var(--text2);"><i class="fa-solid fa-right-from-bracket"></i></button>
          </form>
        </div>
      </div>
    </aside>
    <main class="main-content">
      <header class="header">
        <div class="header__left">
          <button class="header__toggle" id="mobileToggle"><i class="fa-solid fa-bars"></i></button>
          <div class="header__breadcrumb">
            <a href="{{ route('admin.home') }}">Dashboard</a>
            <span><i class="fa-solid fa-chevron-right"></i></span>
            <span class="current">@yield('title', 'Dashboard')</span>
          </div>
        </div>
        <div class="header__right">
          <span style="font-size:13px;color:var(--text2);font-weight:500;">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
      </header>
      <div class="page-content">
        @if(session('success'))
        <div class="alert alert--success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert--error">{{ $errors->first() }}</div>
        @endif
        @yield('content')
      </div>
    </main>
  </div>
  @include('admin.layouts.partials.scripts')
  <script>
    document.getElementById('mobileToggle')?.addEventListener('click', function() {
      document.querySelector('.sidebar')?.classList.toggle('collapsed');
    });
  </script>
  @stack('scripts')
</body>
</html>
