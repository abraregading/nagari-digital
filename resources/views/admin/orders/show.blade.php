@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="page-header">
  <div class="page-header__left">
    <h1>Detail Pesanan</h1>
    <p>Invoice: <strong>{{ $order->invoice }}</strong></p>
  </div>
  <div class="page-header__actions">
    <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn btn--secondary btn--sm"><i class="fa-solid fa-print"></i> Cetak Invoice</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn--secondary btn--sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
  </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">
  <div class="card">
    <div class="card__header"><h3>Informasi Pesanan</h3></div>
    <div class="card__body">
      <table style="width:100%;">
        <tr><td style="padding:8px 0;color:var(--text2);width:150px;">Invoice</td><td style="padding:8px 0;"><strong>{{ $order->invoice }}</strong></td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Vendor</td><td style="padding:8px 0;">{{ config('company.name') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Client</td><td style="padding:8px 0;">{{ $order->user->name ?? '-' }}<br><small style="color:var(--text2);">{{ $order->user->email ?? '' }} {{ $order->user->phone ? '/ '.$order->user->phone : '' }}</small></td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Paket</td><td style="padding:8px 0;">{{ $order->pricingPlan->name ?? '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Durasi</td><td style="padding:8px 0;">{{ $order->getDurationLabel() ?: '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">DPP</td><td style="padding:8px 0;">Rp {{ number_format($order->getSubtotal(), 0, ',', '.') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">PPN {{ $order->getTaxRate() }}%</td><td style="padding:8px 0;">Rp {{ number_format($order->getTaxAmount(), 0, ',', '.') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);font-weight:700;border-top:2px solid #e5e7eb;padding-top:10px;">Total Dibayarkan</td><td style="padding:8px 0;font-weight:700;color:var(--primary);border-top:2px solid #e5e7eb;padding-top:10px;">Rp {{ number_format($order->amount, 0, ',', '.') }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Status</td>
          <td style="padding:8px 0;">
            @if($order->status === 'pending')
              <span class="badge badge--warning">Pending</span>
            @elseif($order->status === 'paid')
              <span class="badge badge--info">Lunas</span>
            @elseif($order->status === 'active')
              <span class="badge badge--success">Aktif</span>
            @else
              <span class="badge badge--error">Dibatalkan</span>
            @endif
          </td>
        </tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Metode Pembayaran</td><td style="padding:8px 0;">{{ $order->payment_channel ?: '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Transaction ID</td><td style="padding:8px 0;">{{ $order->transaction_id ?: '-' }}</td></tr>
        <tr><td style="padding:8px 0;color:var(--text2);">Tanggal Order</td><td style="padding:8px 0;">{{ $order->created_at->format('d M Y H:i') }}</td></tr>
        @if($order->paid_at)
        <tr><td style="padding:8px 0;color:var(--text2);">Dibayar</td><td style="padding:8px 0;">{{ $order->paid_at->format('d M Y H:i') }}</td></tr>
        @endif
        @if($order->activated_at)
        <tr><td style="padding:8px 0;color:var(--text2);">Diaktifkan</td><td style="padding:8px 0;">{{ $order->activated_at->format('d M Y H:i') }}</td></tr>
        @endif
      </table>

      @if($order->payment_details)
      <div style="margin-top:20px;padding-top:16px;border-top:1px solid #e5e7eb;">
        <h4 style="font-size:13px;font-weight:600;margin:0 0 8px;">Detail Pembayaran (JSON)</h4>
        <pre style="background:#f9fafb;padding:12px;border-radius:8px;font-size:11px;overflow-x:auto;max-height:300px;">{{ json_encode($order->payment_details, JSON_PRETTY_PRINT) }}</pre>
      </div>
      @endif
    </div>
  </div>

  <div>
    <div class="card" style="margin-bottom:16px;">
      <div class="card__header"><h3>Aksi</h3></div>
      <div class="card__body" style="display:flex;flex-direction:column;gap:8px;">
        @if($order->status === 'pending')
        <form method="POST" action="{{ route('admin.orders.mark-paid', $order) }}">
          @csrf
          <button type="submit" class="btn btn--primary" style="width:100%;"><i class="fa-solid fa-check"></i> Tandai Lunas</button>
        </form>
        @endif
        @if($order->status === 'paid')
        <form method="POST" action="{{ route('admin.orders.activate', $order) }}">
          @csrf
          <button type="submit" class="btn btn--success" style="width:100%;"><i class="fa-solid fa-check-circle"></i> Aktifkan Client</button>
        </form>
        @endif
        @if(in_array($order->status, ['pending', 'paid']))
        <form method="POST" action="{{ route('admin.orders.cancel', $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
          @csrf
          <button type="submit" class="btn btn--danger btn--sm" style="width:100%;"><i class="fa-solid fa-times"></i> Batalkan Pesanan</button>
        </form>
        @endif
        @if(in_array($order->status, ['cancelled', 'pending']))
        <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" onsubmit="return confirm('Yakin ingin menghapus pesanan ini? Data tidak dapat dikembalikan.');">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn--danger btn--sm" style="width:100%;"><i class="fa-solid fa-trash"></i> Hapus Pesanan</button>
        </form>
        @endif
        <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn btn--secondary btn--sm" style="width:100%;"><i class="fa-solid fa-print"></i> Cetak Invoice</a>
      </div>
    </div>

    <div class="card">
      <div class="card__header"><h3>Alur Status</h3></div>
      <div class="card__body">
        <div style="display:flex;flex-direction:column;gap:12px;">
          <div style="display:flex;align-items:center;gap:8px;">
            <div style="width:24px;height:24px;border-radius:50%;background:{{ $order->status === 'pending' || $order->status === 'paid' || $order->status === 'active' ? '#16a34a' : '#e5e7eb' }};display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;"><i class="fa-solid {{ $order->created_at ? 'fa-check' : 'fa-clock' }}"></i></div>
            <div><strong>Pemesanan</strong><br><small style="color:var(--text2);">{{ $order->created_at->format('d M Y H:i') }}</small></div>
          </div>
          <div style="width:2px;height:16px;background:#e5e7eb;margin-left:11px;"></div>
          <div style="display:flex;align-items:center;gap:8px;">
            <div style="width:24px;height:24px;border-radius:50%;background:{{ $order->status === 'paid' || $order->status === 'active' ? '#16a34a' : '#e5e7eb' }};display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;"><i class="fa-solid {{ $order->paid_at ? 'fa-check' : 'fa-clock' }}"></i></div>
            <div><strong>Pembayaran</strong><br><small style="color:var(--text2);">{{ $order->paid_at ? $order->paid_at->format('d M Y H:i') : 'Menunggu' }}</small></div>
          </div>
          <div style="width:2px;height:16px;background:#e5e7eb;margin-left:11px;"></div>
          <div style="display:flex;align-items:center;gap:8px;">
            <div style="width:24px;height:24px;border-radius:50%;background:{{ $order->status === 'active' ? '#16a34a' : '#e5e7eb' }};display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;"><i class="fa-solid {{ $order->activated_at ? 'fa-check' : 'fa-clock' }}"></i></div>
            <div><strong>Aktif</strong><br><small style="color:var(--text2);">{{ $order->activated_at ? $order->activated_at->format('d M Y H:i') : 'Menunggu' }}</small></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
