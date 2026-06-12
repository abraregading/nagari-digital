@extends('client.layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Pesanan Saya</h1><p>Riwayat pemesanan paket Anda</p></div>
  <div class="page-header__actions">
    <a href="{{ route('harga') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-cart-plus"></i> Pesan Baru</a>
  </div>
</div>

@php
  $allOrders = \App\Models\Order::where('user_id', Auth::id())->get();
  $countPending = $allOrders->where('status', 'pending')->count();
  $countPaid = $allOrders->where('status', 'paid')->count();
  $countActive = $allOrders->where('status', 'active')->count();
  $countCancelled = $allOrders->where('status', 'cancelled')->count();
@endphp

<div class="orders-stats">
  <div class="orders-stat" onclick="location.href='{{ route('client.orders.index') }}'" style="cursor:pointer;">
    <div class="orders-stat__icon orders-stat__icon--all"><i class="fa-solid fa-receipt"></i></div>
    <div class="orders-stat__value">{{ $allOrders->count() }}</div>
    <div class="orders-stat__label">Semua</div>
  </div>
  <div class="orders-stat" onclick="location.href='{{ route('client.orders.index') }}?status=pending'" style="cursor:pointer;">
    <div class="orders-stat__icon orders-stat__icon--pending"><i class="fa-solid fa-clock"></i></div>
    <div class="orders-stat__value">{{ $countPending }}</div>
    <div class="orders-stat__label">Pending</div>
  </div>
  <div class="orders-stat" onclick="location.href='{{ route('client.orders.index') }}?status=paid'" style="cursor:pointer;">
    <div class="orders-stat__icon orders-stat__icon--paid"><i class="fa-solid fa-credit-card"></i></div>
    <div class="orders-stat__value">{{ $countPaid }}</div>
    <div class="orders-stat__label">Lunas</div>
  </div>
  <div class="orders-stat" onclick="location.href='{{ route('client.orders.index') }}?status=active'" style="cursor:pointer;">
    <div class="orders-stat__icon orders-stat__icon--active"><i class="fa-solid fa-check-circle"></i></div>
    <div class="orders-stat__value">{{ $countActive }}</div>
    <div class="orders-stat__label">Aktif</div>
  </div>
  <div class="orders-stat" onclick="location.href='{{ route('client.orders.index') }}?status=cancelled'" style="cursor:pointer;">
    <div class="orders-stat__icon orders-stat__icon--cancelled"><i class="fa-solid fa-ban"></i></div>
    <div class="orders-stat__value">{{ $countCancelled }}</div>
    <div class="orders-stat__label">Dibatalkan</div>
  </div>
</div>

<div class="card">
  @if($orders->isNotEmpty())
  <div class="card__header" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
    <h3><i class="fa-solid fa-list" style="color:var(--primary);margin-right:8px;"></i>Daftar Pesanan</h3>
    <form method="GET" class="orders-filter">
      <select name="status" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
      </select>
      <input type="text" name="search" placeholder="Cari invoice..." value="{{ request('search') }}">
      <button type="submit" class="btn btn--ghost btn--sm"><i class="fa-solid fa-search"></i></button>
      @if(request('search') || request('status'))
      <a href="{{ route('client.orders.index') }}" class="btn btn--ghost btn--sm" style="color:var(--text2);"><i class="fa-solid fa-times"></i></a>
      @endif
    </form>
  </div>
  @endif
  <div class="card__body" style="padding:0;">
    @if($orders->isEmpty())
    <div class="orders-empty">
      <div class="orders-empty__icon"><i class="fa-solid fa-receipt"></i></div>
      @if($allOrders->isEmpty())
      <h3>Belum Ada Pesanan</h3>
      <p>Anda belum memiliki pesanan apapun.</p>
      <a href="{{ route('harga') }}" class="btn btn--primary">Lihat Paket Harga</a>
      @else
      <h3>Tidak Ditemukan</h3>
      <p>Tidak ada pesanan yang cocok dengan filter yang dipilih.</p>
      <a href="{{ route('client.orders.index') }}" class="btn btn--secondary">Reset Filter</a>
      @endif
    </div>
    @else
    <div class="orders-table-wrap">
      <table class="orders-table">
        <thead>
          <tr>
            <th>Invoice</th>
            <th>Paket</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Metode</th>
            <th>Tanggal</th>
            <th class="orders-table__th-actions"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr class="orders-row orders-row--{{ $order->status }}" onclick="location.href='{{ route('client.orders.show', $order) }}'">
            <td>
              <span class="orders-invoice">{{ $order->invoice }}</span>
            </td>
            <td>
              <span class="orders-plan">{{ $order->pricingPlan->name ?? '-' }}</span>
              <span class="orders-duration">{{ $order->getDurationLabel() ?: '-' }}</span>
            </td>
            <td>
              <span class="orders-price">Rp {{ number_format($order->amount, 0, ',', '.') }}</span>
            </td>
            <td>
              @if($order->status === 'pending')
                <span class="order-badge order-badge--pending"><i class="fa-solid fa-clock"></i> Pending</span>
              @elseif($order->status === 'paid')
                <span class="order-badge order-badge--paid"><i class="fa-solid fa-check"></i> Lunas</span>
              @elseif($order->status === 'active')
                <span class="order-badge order-badge--active"><i class="fa-solid fa-check-circle"></i> Aktif</span>
              @else
                <span class="order-badge order-badge--cancelled"><i class="fa-solid fa-ban"></i> Dibatalkan</span>
              @endif
            </td>
            <td>
              @if($order->payment_channel)
              <span class="orders-payment">{{ $order->payment_channel }}</span>
              @else
              <span class="orders-payment orders-payment--none">—</span>
              @endif
            </td>
            <td>
              <span class="orders-date">{{ $order->created_at->format('d M Y') }}</span>
              <span class="orders-time">{{ $order->created_at->format('H:i') }}</span>
            </td>
            <td class="orders-table__td-actions" onclick="event.stopPropagation();">
              <div class="orders-actions">
                <a href="{{ route('client.orders.show', $order) }}" class="orders-action orders-action--view" title="Detail Pesanan"><i class="fa-solid fa-eye"></i></a>
                @if($order->status === 'pending' && !$order->transaction_id)
                <a href="{{ route('client.orders.edit', $order) }}" class="orders-action orders-action--edit" title="Ubah Paket"><i class="fa-solid fa-pen"></i></a>
                <form method="POST" action="{{ route('client.orders.cancel', $order) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin membatalkan pesanan {{ $order->invoice }}?');">
                  @csrf
                  <button type="submit" class="orders-action orders-action--cancel" title="Batalkan Pesanan"><i class="fa-solid fa-xmark"></i></button>
                </form>
                @endif
                @if($order->status === 'cancelled')
                <form method="POST" action="{{ route('client.orders.destroy', $order) }}" style="display:inline;" onsubmit="return confirm('Hapus pesanan {{ $order->invoice }}? Data tidak dapat dikembalikan.');">
                  @csrf @method('DELETE')
                  <button type="submit" class="orders-action orders-action--delete" title="Hapus Pesanan"><i class="fa-solid fa-trash-can"></i></button>
                </form>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>

<style>
  /* ===== Stat Cards ===== */
  .orders-stats {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 12px;
    margin-bottom: 24px;
  }
  .orders-stat {
    background: var(--surface);
    border-radius: var(--radius);
    padding: 18px 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    text-align: center;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
  }
  .orders-stat:nth-child(1) { border-bottom: 3px solid #6b7280; }
  .orders-stat:nth-child(2) { border-bottom: 3px solid #d97706; }
  .orders-stat:nth-child(3) { border-bottom: 3px solid #2563eb; }
  .orders-stat:nth-child(4) { border-bottom: 3px solid #16a34a; }
  .orders-stat:nth-child(5) { border-bottom: 3px solid #dc2626; }
  .orders-stat:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
  }
  .orders-stat__icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 16px;
    margin: 0 auto 8px;
    transition: transform 0.2s;
  }
  .orders-stat:hover .orders-stat__icon {
    transform: scale(1.1);
  }
  .orders-stat__icon--all { background: #f3f4f6; color: #6b7280; }
  .orders-stat__icon--pending { background: #fef3c7; color: #d97706; }
  .orders-stat__icon--paid { background: #dbeafe; color: #2563eb; }
  .orders-stat__icon--active { background: #dcfce7; color: #16a34a; }
  .orders-stat__icon--cancelled { background: #fef2f2; color: #dc2626; }
  .orders-stat__value {
    font-family: var(--heading);
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 2px;
  }
  .orders-stat__label {
    font-size: 12px;
    color: var(--text2);
    margin: 0;
  }

  /* ===== Filter Bar ===== */
  .orders-filter {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .orders-filter select,
  .orders-filter input[type="text"] {
    padding: 7px 10px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 12px;
    font-family: var(--body);
    color: var(--text);
    background: var(--surface);
    outline: none;
    transition: border-color 0.2s;
  }
  .orders-filter select:focus,
  .orders-filter input[type="text"]:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(14,138,74,0.08);
  }
  .orders-filter select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 8px center;
    padding-right: 26px;
  }
  .orders-filter input[type="text"] {
    width: 160px;
  }

  /* ===== Table ===== */
  .orders-table-wrap {
    overflow-x: auto;
  }
  .orders-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
  }
  .orders-table thead {
    background: #f8fafc;
  }
  .orders-table th {
    padding: 11px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: var(--text2);
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
  }
  .orders-table__th-actions {
    width: 1%;
    text-align: right;
  }
  .orders-table__td-actions {
    width: 1%;
    white-space: nowrap;
    text-align: right;
  }

  .orders-row {
    transition: all 0.15s ease;
    cursor: pointer;
  }
  .orders-row td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
  }
  .orders-row:last-child td {
    border-bottom: none;
  }
  .orders-row:hover {
    background: rgba(14,138,74,0.03);
  }
  .orders-row:hover td {
    border-bottom-color: transparent;
  }
  .orders-row:hover + .orders-row td {
    border-top-color: transparent;
  }

  .orders-row--cancelled {
    opacity: 0.65;
  }
  .orders-row--cancelled:hover {
    opacity: 1;
  }

  /* ===== Cell Content ===== */
  .orders-invoice {
    font-weight: 700;
    font-family: var(--heading);
    color: var(--text);
    font-size: 12px;
    letter-spacing: 0.3px;
  }
  .orders-plan {
    font-weight: 500;
  }
  .orders-duration {
    display: block;
    font-size: 11px;
    color: var(--text2);
    margin-top: 2px;
  }
  .orders-price {
    font-weight: 600;
    font-family: var(--heading);
    color: var(--primary);
  }
  .orders-payment {
    font-size: 12px;
    color: var(--text2);
  }
  .orders-payment--none {
    color: #d1d5db;
  }
  .orders-date {
    display: block;
    font-size: 12px;
    font-weight: 500;
  }
  .orders-time {
    display: block;
    font-size: 11px;
    color: var(--text2);
  }

  /* ===== Badges ===== */
  .order-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
  }
  .order-badge i {
    font-size: 10px;
  }
  .order-badge--pending {
    background: #fef3c7;
    color: #b45309;
  }
  .order-badge--paid {
    background: #dbeafe;
    color: #1d4ed8;
  }
  .order-badge--active {
    background: #dcfce7;
    color: #15803d;
  }
  .order-badge--cancelled {
    background: #fef2f2;
    color: #b91c1c;
  }

  /* ===== Action Buttons ===== */
  .orders-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 4px;
  }
  .orders-action {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
    background: transparent;
    color: var(--text2);
    transition: all 0.2s ease;
  }
  .orders-action:hover {
    transform: translateY(-1px);
  }
  .orders-action--view:hover {
    background: #f3f4f6;
    color: var(--primary);
  }
  .orders-action--edit:hover {
    background: #fef3c7;
    color: #d97706;
  }
  .orders-action--cancel:hover {
    background: #fef2f2;
    color: #dc2626;
  }
  .orders-action--delete:hover {
    background: #fef2f2;
    color: #dc2626;
  }

  /* ===== Empty State ===== */
  .orders-empty {
    text-align: center;
    padding: 60px 24px;
  }
  .orders-empty__icon {
    width: 72px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    background: #f3f4f6;
    border-radius: 20px;
    font-size: 28px;
    color: #d1d5db;
  }
  .orders-empty h3 {
    font-family: var(--heading);
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 6px;
  }
  .orders-empty p {
    color: var(--text2);
    font-size: 14px;
    margin: 0 0 20px;
  }

  /* ===== Responsive ===== */
  @media (max-width: 900px) {
    .orders-stats {
      grid-template-columns: repeat(3, 1fr);
    }
    .orders-filter input[type="text"] {
      width: 120px;
    }
  }
  @media (max-width: 600px) {
    .orders-stats {
      grid-template-columns: repeat(2, 1fr);
    }
    .orders-filter {
      width: 100%;
    }
    .orders-filter select {
      flex: 1;
    }
    .orders-filter input[type="text"] {
      flex: 1;
      width: auto;
    }
    .orders-table th:nth-child(5),
    .orders-table td:nth-child(5) {
      display: none;
    }
  }
</style>
@endsection
