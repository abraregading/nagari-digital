<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') — Client {{ $settings['site_name'] ?? 'Nagari Digital' }}</title>
  @include('admin.layouts.partials.head')
  <style>
    .client-layout { display:flex;min-height:100vh; }
    .client-sidebar { width:260px;background:var(--sidebar-bg,#1e293b);display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:100;transition:transform .3s; }
    .client-sidebar.collapsed { transform:translateX(-100%); }
    .client-main { flex:1;margin-left:260px;transition:margin .3s; }
    .client-main.expanded { margin-left:0; }
    .client-header { display:flex;align-items:center;justify-content:space-between;padding:16px 24px;background:#fff;border-bottom:1px solid #e5e7eb; }
    .client-content { padding:24px; }
    .sidebar__user-role { font-size:11px;color:#94a3b8; }
    @media(max-width:768px) {
      .client-sidebar { transform:translateX(-100%); }
      .client-sidebar.mobile-open { transform:translateX(0); }
      .client-main { margin-left:0; }
    }
    .order-status { padding:4px 10px;border-radius:999px;font-size:11px;font-weight:600;display:inline-block; }
    .order-status--pending { background:#fef3c7;color:#d97706; }
    .order-status--paid { background:#dbeafe;color:#2563eb; }
    .order-status--active { background:#dcfce7;color:#16a34a; }
    .order-status--cancelled { background:#fef2f2;color:#dc2626; }
  </style>
</head>
<body>
  <div class="client-layout">
    <aside class="client-sidebar" id="clientSidebar">
      <div class="sidebar__header">
        <div class="sidebar__logo-icon"><i class="fa-solid {{ $settings['logo_icon'] ?? 'fa-leaf' }}"></i></div>
        <span class="sidebar__logo-text">{{ $settings['site_name'] ?? 'Nagari' }}<span class="sidebar__logo-accent">Digital</span></span>
      </div>
      <nav class="sidebar__nav">
        @php $currentRoute = request()->route()?->getName(); @endphp
        <div class="sidebar__section">
          <div class="sidebar__section-title">Client Area</div>
          <a href="{{ route('client.dashboard') }}" class="sidebar__link {{ str_starts_with($currentRoute, 'client.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i><span>Dashboard</span>
          </a>
          <a href="{{ route('client.orders.index') }}" class="sidebar__link {{ str_starts_with($currentRoute, 'client.orders') ? 'active' : '' }}">
            <i class="fa-solid fa-receipt"></i><span>Pesanan Saya</span>
          </a>
          <a href="{{ route('harga') }}" class="sidebar__link">
            <i class="fa-solid fa-cart-plus"></i><span>Pesan Paket Baru</span>
          </a>
        </div>
      </nav>
      <div class="sidebar__footer">
        <div class="sidebar__user">
          <div class="sidebar__user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'C', 0, 2)) }}</div>
          <div class="sidebar__user-info">
            <div class="sidebar__user-name">{{ Auth::user()->name ?? 'Client' }}</div>
            <div class="sidebar__user-role">Client</div>
          </div>
          <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn--ghost btn--sm" title="Logout" style="color:var(--text2);"><i class="fa-solid fa-right-from-bracket"></i></button>
          </form>
        </div>
      </div>
    </aside>
    <main class="client-main" id="clientMain">
      <header class="client-header">
        <div>
          <button class="header__toggle" id="clientToggle" style="background:none;border:none;font-size:20px;cursor:pointer;margin-right:12px;"><i class="fa-solid fa-bars"></i></button>
          <span style="font-weight:600;">@yield('title', 'Dashboard')</span>
        </div>
        <span style="font-size:13px;color:var(--text2);">{{ Auth::user()->name }}</span>
      </header>
      <div class="client-content">
        @if(session('success'))
        <div class="alert alert--success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert--error">{{ session('error') }}</div>
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
    document.getElementById('clientToggle')?.addEventListener('click', function() {
      document.getElementById('clientSidebar')?.classList.toggle('mobile-open');
    });
  </script>
  @stack('scripts')
</body>
</html>
