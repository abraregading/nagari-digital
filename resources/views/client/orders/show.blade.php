@extends('client.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="page-header">
  <div class="page-header__left">
    <h1>Detail Pesanan</h1>
    <p>Invoice: <strong>{{ $order->invoice }}</strong></p>
  </div>
  <div class="page-header__actions">
    <a href="{{ route('client.orders.invoice', $order) }}" target="_blank" class="btn btn--secondary btn--sm"><i class="fa-solid fa-print"></i> Cetak Invoice</a>
    <a href="{{ route('client.orders.index') }}" class="btn btn--secondary btn--sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
  </div>
</div>

@if($paymentStatus === 'success')
<div class="alert alert--success" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#dcfce7;color:#16a34a;border-radius:8px;margin-bottom:20px;">
  <i class="fa-solid fa-circle-check" style="font-size:20px;"></i>
  <div><strong>Pembayaran berhasil!</strong> Pesanan Anda sedang diproses. Tim kami akan mengaktifkan paket Anda segera.</div>
</div>
@elseif($paymentStatus === 'pending')
<div class="alert alert--warning" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#fef3c7;color:#d97706;border-radius:8px;margin-bottom:20px;">
  <i class="fa-solid fa-clock" style="font-size:20px;"></i>
  <div><strong>Pembayaran menunggu dikonfirmasi.</strong> Jika sudah melakukan pembayaran, silakan tunggu beberapa saat hingga status berubah.</div>
</div>
@elseif($paymentStatus === 'error')
<div class="alert alert--error" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#fef2f2;color:#dc2626;border-radius:8px;margin-bottom:20px;">
  <i class="fa-solid fa-circle-exclamation" style="font-size:20px;"></i>
  <div><strong>Pembayaran gagal.</strong> Silakan coba lagi atau hubungi tim kami.</div>
</div>
@endif

@if(session('success'))
<div class="alert alert--success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert--error">{{ session('error') }}</div>
@endif

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">
  <div class="card">
    <div class="card__header"><h3>Informasi Pesanan</h3></div>
    <div class="card__body">
      <table style="width:100%;">
        <tr><td style="padding:8px 0;color:var(--text2);width:140px;">Invoice</td><td style="padding:8px 0;"><strong>{{ $order->invoice }}</strong></td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Paket</td><td style="padding:8px 0;">{{ $order->pricingPlan->name ?? '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Durasi</td><td style="padding:8px 0;">{{ $order->getDurationLabel() ?: '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Vendor</td><td style="padding:8px 0;">{{ config('company.name') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">DPP</td><td style="padding:8px 0;">Rp {{ number_format($order->getSubtotal(), 0, ',', '.') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">PPN {{ $order->getTaxRate() }}%</td><td style="padding:8px 0;">Rp {{ number_format($order->getTaxAmount(), 0, ',', '.') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);font-weight:700;border-top:2px solid #e5e7eb;padding-top:10px;">Total Dibayarkan</td><td style="padding:8px 0;font-weight:700;color:var(--primary);border-top:2px solid #e5e7eb;padding-top:10px;">Rp {{ number_format($order->amount, 0, ',', '.') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Status</td>
          <td style="padding:8px 0;">
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
        </tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Metode</td><td style="padding:8px 0;">{{ $order->payment_channel ?: '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Tanggal Order</td><td style="padding:8px 0;">{{ $order->created_at->format('d M Y H:i') }}</td></tr>
        @if($order->paid_at)
        <tr><td style="padding:8px 0;color:var(--text2);">Dibayar</td><td style="padding:8px 0;">{{ $order->paid_at->format('d M Y H:i') }}</td></tr>
        @endif
        @if($order->activated_at)
        <tr><td style="padding:8px 0;color:var(--text2);">Diaktifkan</td><td style="padding:8px 0;">{{ $order->activated_at->format('d M Y H:i') }}</td></tr>
        @endif
      </table>
    </div>
  </div>

  <div>
    @if($order->status === 'pending' && !$order->transaction_id)
    <div class="card" style="margin-bottom:16px;">
      <div class="card__header"><h3>Aksi</h3></div>
      <div class="card__body" style="display:flex;flex-direction:column;gap:8px;">
        <p style="font-size:13px;color:var(--text2);margin-bottom:4px;">Pesanan ini belum dibayar. Lanjutkan pembayaran sekarang.</p>
        <a href="{{ route('client.orders.pay', $order) }}" class="btn btn--primary" style="width:100%;">
          <i class="fa-solid fa-credit-card"></i> Bayar Sekarang
        </a>
        <a href="{{ route('client.orders.edit', $order) }}" class="btn btn--secondary btn--sm" style="width:100%;">
          <i class="fa-solid fa-pen"></i> Ubah Paket
        </a>
        <form method="POST" action="{{ route('client.orders.cancel', $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
          @csrf
          <button type="submit" class="btn btn--danger btn--sm" style="width:100%;"><i class="fa-solid fa-times"></i> Batalkan Pesanan</button>
        </form>
      </div>
    </div>
    @endif

    @if(in_array($order->status, ['cancelled']) || ($order->status === 'pending' && $order->transaction_id))
    <div class="card" style="margin-bottom:16px;">
      <div class="card__header"><h3>Aksi</h3></div>
      <div class="card__body" style="display:flex;flex-direction:column;gap:8px;">
        @if($order->status === 'cancelled')
        <form method="POST" action="{{ route('client.orders.destroy', $order) }}" onsubmit="return confirm('Yakin ingin menghapus pesanan ini? Data tidak dapat dikembalikan.');">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn--danger btn--sm" style="width:100%;"><i class="fa-solid fa-trash"></i> Hapus Pesanan</button>
        </form>
        @endif
      </div>
    </div>
    @endif

    @if($order->status === 'pending' && $order->transaction_id && $order->payment_channel)
    <div class="card" style="margin-bottom:16px;">
      <div class="card__header"><h3>Cara Pembayaran</h3></div>
      <div class="card__body">
        <p style="font-size:13px;font-weight:600;margin-bottom:8px;">Silakan selesaikan pembayaran melalui:</p>
        <div style="background:#f9fafb;padding:12px;border-radius:8px;font-size:13px;">
          <strong>{{ $order->payment_channel }}</strong><br>
          @if(str_contains($order->payment_channel ?? '', ' - '))
            <span style="font-size:11px;color:var(--text2);">Virtual Account</span>
          @endif
        </div>
        <p style="font-size:12px;color:var(--text2);margin-top:12px;">Setelah transfer, status akan berubah otomatis dalam beberapa menit.</p>
      </div>
    </div>
    @endif

    <div class="card">
      <div class="card__header"><h3>Detail Paket</h3></div>
      <div class="card__body">
        @if($order->pricingPlan)
        <p style="font-size:18px;font-weight:700;margin:0 0 4px;">{{ $order->pricingPlan->name }}</p>
        <p style="color:var(--text2);font-size:13px;margin:0 0 12px;">{{ $order->pricingPlan->tagline }}</p>
        <p style="font-size:24px;font-weight:800;color:var(--primary);">Rp {{ number_format($order->pricingPlan->price['bulanan'] ?? 0, 0, ',', '.') }}<span style="font-size:13px;font-weight:400;color:var(--text2);">/bulan</span></p>
        <p style="font-size:12px;color:var(--text2);margin-top:12px;">* Harga sudah termasuk PPN {{ $order->getTaxRate() }}%</p>
        @else
        <p style="color:var(--text2);">Informasi paket tidak tersedia.</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
