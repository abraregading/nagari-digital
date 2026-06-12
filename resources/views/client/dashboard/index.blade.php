@extends('client.layouts.app')

@section('title', 'Dashboard Client')

@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Dashboard</h1><p>Selamat datang, {{ $user->name }}!</p></div>
  <div class="page-header__actions">
    <a href="{{ route('harga') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-cart-plus"></i> Pesan Paket Baru</a>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card" style="cursor:pointer;" onclick="location.href='{{ route('client.orders.index') }}'">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--green"><i class="fa-solid fa-check-circle"></i></div></div>
    <div class="stat-card__value">{{ $activeOrders }}</div>
    <p class="stat-card__label">Paket Aktif</p>
  </div>
  <div class="stat-card" style="cursor:pointer;" onclick="location.href='{{ route('client.orders.index') }}'">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--amber"><i class="fa-solid fa-clock"></i></div></div>
    <div class="stat-card__value">{{ $pendingOrders }}</div>
    <p class="stat-card__label">Menunggu Pembayaran</p>
  </div>
  <div class="stat-card" style="cursor:pointer;" onclick="location.href='{{ route('client.orders.index') }}'">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--blue"><i class="fa-solid fa-receipt"></i></div></div>
    <div class="stat-card__value">{{ $totalOrders }}</div>
    <p class="stat-card__label">Total Pesanan</p>
  </div>
</div>

@if($orders->isNotEmpty())
<div class="card" style="margin-top:24px;">
  <div class="card__header"><h3>Pesanan Terbaru</h3></div>
  <div class="card__body" style="padding:0;">
    <table class="table">
      <thead>
        <tr>
          <th>Invoice</th>
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
          <td>{{ $order->pricingPlan->name ?? '-' }}</td>
          <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
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
          <td>
            @if($order->status === 'pending' && !$order->transaction_id)
              <a href="{{ route('client.orders.pay', $order) }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-credit-card"></i> Bayar</a>
            @else
              <a href="{{ route('client.orders.show', $order) }}" class="btn btn--ghost btn--sm">Detail</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
@endsection
