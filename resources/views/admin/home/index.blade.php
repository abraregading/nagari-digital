@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Dashboard</h1><p>Ringkasan statistik website SaaS Nagari Digital</p></div>
  <div class="page-header__actions">
    <a href="{{ route('home') }}" target="_blank" class="btn btn--secondary btn--sm"><i class="fa-solid fa-eye"></i> Lihat Website</a>
    <button class="btn btn--secondary btn--sm" onclick="location.reload()"><i class="fa-solid fa-rotate"></i> Refresh</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--green"><i class="fa-solid fa-cube"></i></div><span class="stat-card__trend stat-card__trend--up"><i class="fa-solid fa-arrow-up"></i> Aktif</span></div>
    <div class="stat-card__value">{{ $productCount }}</div>
    <p class="stat-card__label">Produk / Aplikasi</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--blue"><i class="fa-solid fa-star"></i></div></div>
    <div class="stat-card__value">{{ $testimonialCount }}</div>
    <p class="stat-card__label">Testimonial</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--purple"><i class="fa-solid fa-building-columns"></i></div></div>
    <div class="stat-card__value">{{ $nagariCount }}</div>
    <p class="stat-card__label">Nagari Terdaftar</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--amber"><i class="fa-solid fa-envelope"></i></div></div>
    <div class="stat-card__value">{{ $messageCount }}</div>
    <p class="stat-card__label">Total Pesan Masuk</p>
  </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">
  <div class="card">
    <div class="card__header"><h3>Pesan Terbaru</h3><a href="{{ route('admin.messages.index') }}" style="font-size:12px;color:var(--primary);text-decoration:none;">Lihat Semua</a></div>
    <div class="card__body" style="padding:8px 20px;">
      <ul class="activity-list">
        @forelse($recentMessages as $msg)
        <li class="activity-item">
          <div class="activity-item__icon" style="background:{{ $msg->is_read ? '#f3f4f6' : '#dcfce7' }};color:{{ $msg->is_read ? '#6b7280' : '#16a34a' }};">
            <i class="fa-solid {{ $msg->is_read ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
          </div>
          <div class="activity-item__content">
            <div class="activity-item__text"><strong>{{ $msg->name }}</strong> — {{ $msg->paket ?: 'Konsultasi' }}</div>
            <div class="activity-item__time">{{ $msg->created_at->format('d M Y H:i') }} • {{ $msg->nagari }}</div>
          </div>
          @if(!$msg->is_read) <span class="badge badge--success">Baru</span> @endif
        </li>
        @empty
        <li class="activity-item"><p style="color:var(--text2);">Belum ada pesan.</p></li>
        @endforelse
      </ul>
    </div>
  </div>
</div>

<div class="grid-4" style="margin-top:24px;">
  <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='{{ route('admin.settings.index') }}'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#dcfce7;color:#16a34a;"><i class="fa-solid fa-house"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Kelola Homepage</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;">Hero, Stats, Kenapa Kami</p>
  </div>
  <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='{{ route('admin.products.index') }}'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#dbeafe;color:#2563eb;"><i class="fa-solid fa-cube"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Kelola Produk</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;">5 Aplikasi + Fitur</p>
  </div>
  <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='{{ route('admin.pricing-plans.index') }}'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#fef3c7;color:#d97706;"><i class="fa-solid fa-tags"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Kelola Harga</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;">Paket & Perbandingan</p>
  </div>
  <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='{{ route('admin.messages.index') }}'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#fce7f3;color:#e11d48;"><i class="fa-solid fa-envelope"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Pesan Masuk</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;"><span>{{ $unreadCount }}</span> pesan belum dibaca</p>
  </div>
</div>
@endsection
