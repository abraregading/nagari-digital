@extends('client.layouts.app')

@section('title', 'Pembayaran')

@section('content')
<style>
  .invoice-mini { max-width:210mm;margin:0 auto 24px;background:#fff;border-radius:12px;box-shadow:0 1px 3px rgba(0,0,0,.08);overflow:hidden; }
  .invoice-mini__inner { padding:24px 32px; }
  .invoice-mini__row { display:flex;justify-content:space-between;padding:6px 0;font-size:13px; }
  .invoice-mini__row.total { font-size:14px;font-weight:800;color:var(--primary);border-top:2px solid #e5e7eb;padding-top:10px;margin-top:4px; }
</style>

<div class="page-header">
  <div class="page-header__left"><h1>Pembayaran</h1><p>Invoice: <strong>{{ $order->invoice }}</strong></p></div>
</div>

<div style="max-width:600px;margin:0 auto;">
  <div class="invoice-mini">
    <div class="invoice-mini__inner">
      <h4 style="margin:0 0 12px;color:#374151;">{{ config('company.name') }}</h4>
      <div style="border-top:1px solid #e5e7eb;padding-top:12px;">
        <div class="invoice-mini__row"><span>Paket</span><strong>{{ $order->pricingPlan->name ?? '-' }}</strong></div>
        <div class="invoice-mini__row"><span>Invoice</span><span>{{ $order->invoice }}</span></div>
        <div class="invoice-mini__row"><span>DPP</span><span>Rp {{ number_format($order->getSubtotal(), 0, ',', '.') }}</span></div>
        <div class="invoice-mini__row"><span>PPN {{ $order->getTaxRate() }}%</span><span>Rp {{ number_format($order->getTaxAmount(), 0, ',', '.') }}</span></div>
        <div class="invoice-mini__row total"><span>Total Dibayarkan</span><span>Rp {{ number_format($order->amount, 0, ',', '.') }}</span></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card__body" style="text-align:center;">
      <i class="fa-solid fa-spinner fa-spin" style="font-size:36px;color:var(--primary);margin-bottom:16px;"></i>
      <h3>Mengarahkan ke halaman pembayaran...</h3>
      <p style="color:var(--text2);">Jangan tutup halaman ini.</p>
    </div>
  </div>
</div>

<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com' : 'https://app.sandbox.midtrans.com' }}/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    function sendCallback(status, result) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '{{ route("client.payment.callback") }}');
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
      xhr.onload = function() {
        window.location.href = '{{ route("client.orders.show", [$order, "status" => "SUCCESS"]) }}'.replace('SUCCESS', status);
      };
      xhr.onerror = function() {
        window.location.href = '{{ route("client.orders.show", [$order, "status" => "SUCCESS"]) }}'.replace('SUCCESS', status);
      };
      xhr.send(JSON.stringify(result));
    }

    window.snap.pay('{{ $snapToken }}', {
      onSuccess: function(result) { sendCallback('success', result); },
      onPending: function(result) { sendCallback('pending', result); },
      onError: function(result) { sendCallback('error', result); },
      onClose: function() {
        window.location.href = '{{ route("client.orders.show", $order) }}';
      }
    });
  });
</script>
@endsection
