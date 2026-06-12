@extends('admin.layouts.app')

@section('title', 'Pesanan')

@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Pesanan Client</h1><p>Kelola pesanan paket dari client</p></div>
</div>

<div class="stats-grid" style="margin-bottom:24px;">
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--blue"><i class="fa-solid fa-receipt"></i></div></div>
    <div class="stat-card__value">{{ $counts['total'] }}</div>
    <p class="stat-card__label">Total Pesanan</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--amber"><i class="fa-solid fa-clock"></i></div></div>
    <div class="stat-card__value">{{ $counts['pending'] }}</div>
    <p class="stat-card__label">Pending</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--blue"><i class="fa-solid fa-credit-card"></i></div></div>
    <div class="stat-card__value">{{ $counts['paid'] }}</div>
    <p class="stat-card__label">Lunas</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--green"><i class="fa-solid fa-check-circle"></i></div></div>
    <div class="stat-card__value">{{ $counts['active'] }}</div>
    <p class="stat-card__label">Aktif</p>
  </div>
  <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--purple"><i class="fa-solid fa-money-bill-trend-up"></i></div></div>
    <div class="stat-card__value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
    <p class="stat-card__label">Total Pendapatan</p>
  </div>
</div>

<div class="card">
  <div class="card__header" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
    <h3>Daftar Pesanan</h3>
    <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;">
      <select name="status" class="form-input" style="width:auto;padding:6px 12px;" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
      </select>
      <input type="text" name="search" class="form-input" style="width:200px;padding:6px 12px;" placeholder="Cari invoice/email..." value="{{ request('search') }}">
      <button type="submit" class="btn btn--secondary btn--sm"><i class="fa-solid fa-search"></i></button>
    </form>
  </div>
  <div class="card__body" style="padding:0;">
    @if($orders->isEmpty())
    <div style="text-align:center;padding:48px;color:var(--text2);">
      <i class="fa-solid fa-receipt" style="font-size:48px;margin-bottom:16px;opacity:.3;"></i>
      <p>Belum ada pesanan.</p>
    </div>
    @else
    <table class="table">
      <thead>
        <tr>
          <th>Invoice</th>
          <th>Client</th>
          <th>Paket</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td><strong>{{ $order->invoice }}</strong></td>
          <td>{{ $order->user->name ?? '-' }}<br><small style="color:var(--text2);">{{ $order->user->email ?? '' }}</small></td>
          <td>{{ $order->pricingPlan->name ?? '-' }}</td>
            <td>Rp {{ number_format($order->amount, 0, ',', '.') }}
            @if($order->getDurationLabel() !== '-')
            <br><small style="color:var(--text2);font-size:11px;">{{ $order->getDurationLabel() }}</small>
            @endif
            </td>
          <td>
            @if($order->status === 'pending')
              <span class="order-status order-status--pending">Pending</span>
            @elseif($order->status === 'paid')
              <span class="order-status order-status--paid">Lunas</span>
            @elseif($order->status === 'active')
              <span class="order-status order-status--active">Aktif</span>
            @else
              <span class="order-status order-status--cancelled">Dibatalkan</span>
            @endif
          </td>
          <td>{{ $order->created_at->format('d M Y') }}</td>
          <td style="white-space:nowrap;">
            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn--ghost btn--sm">Detail</a>
            <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn btn--ghost btn--sm"><i class="fa-solid fa-print"></i></a>
            @if(in_array($order->status, ['cancelled', 'pending']))
            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" style="display:inline;" onsubmit="return confirm('Hapus pesanan ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn--ghost btn--sm" style="color:#dc2626;"><i class="fa-solid fa-trash"></i></button>
            </form>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
  @if($orders->hasPages())
  <div class="card__footer" style="padding:12px 20px;">
    {{ $orders->links() }}
  </div>
  @endif
</div>

<style>
  .pagination { display:flex;gap:4px;list-style:none;padding:0;margin:0; }
  .pagination a, .pagination span { display:inline-block;padding:6px 12px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;text-decoration:none;color:var(--text); }
  .pagination .active span { background:var(--primary);color:#fff;border-color:var(--primary); }
  .order-status { padding:4px 10px;border-radius:999px;font-size:11px;font-weight:600;display:inline-block; }
  .order-status--pending { background:#fef3c7;color:#d97706; }
  .order-status--paid { background:#dbeafe;color:#2563eb; }
  .order-status--active { background:#dcfce7;color:#16a34a; }
  .order-status--cancelled { background:#fef2f2;color:#dc2626; }
</style>
@endsection
