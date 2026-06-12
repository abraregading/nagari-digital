@extends('client.layouts.app')

@section('title', 'Checkout')

@section('content')
<style>
  .invoice-a4 {
    max-width: 210mm;
    margin: 0 auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .invoice-a4__inner { padding: 40px; }
  .invoice-a4__header { display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:32px;padding-bottom:24px;border-bottom:2px solid #f3f4f6; }
  .invoice-a4__vendor h2 { margin:0 0 4px;font-size:18px;font-weight:700;color:#111827; }
  .invoice-a4__vendor p { margin:0;font-size:12px;color:#6b7280;line-height:1.6; }
  .invoice-a4__title { text-align:right; }
  .invoice-a4__title h1 { margin:0;font-size:24px;font-weight:800;color:var(--primary);letter-spacing:2px; }
  .invoice-a4__title p { margin:4px 0 0;font-size:12px;color:#6b7280; }
  .invoice-a4__info { display:flex;justify-content:space-between;margin-bottom:28px;padding-bottom:20px;border-bottom:1px solid #e5e7eb; }
  .invoice-a4__bill h4, .invoice-a4__meta h4 { margin:0 0 6px;font-size:11px;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;font-weight:600; }
  .invoice-a4__bill p, .invoice-a4__meta p { margin:0;font-size:13px;color:#374151;line-height:1.5; }
  .invoice-a4__meta { text-align:right; }
  .invoice-a4__table { width:100%;border-collapse:collapse;margin-bottom:24px; }
  .invoice-a4__table th { text-align:left;padding:10px 0;font-size:11px;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;font-weight:600;border-bottom:1px solid #e5e7eb; }
  .invoice-a4__table td { padding:12px 0;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6; }
  .invoice-a4__table td:last-child, .invoice-a4__table th:last-child { text-align:right; }
  .invoice-a4__totals { margin-left:auto;width:320px; }
  .invoice-a4__totals table { width:100%; }
  .invoice-a4__totals td { padding:6px 0;font-size:13px; }
  .invoice-a4__totals td:last-child { text-align:right;font-weight:600;white-space:nowrap; }
  .invoice-a4__totals .sep td { border-top:2px solid #e5e7eb;padding-top:8px; }
  .invoice-a4__totals .grand td { font-size:14px;font-weight:800;color:var(--primary);padding-top:8px; }
  .invoice-a4__totals .grand td:last-child { font-size:15px; }
  .invoice-a4__terms { margin-top:24px;padding-top:16px;border-top:1px solid #e5e7eb;font-size:11px;color:#9ca3af;line-height:1.6; }
  .invoice-a4__action { margin-top:28px;text-align:center; }
  .invoice-a4__footer { text-align:center;padding:16px 40px;background:#f9fafb;font-size:11px;color:#9ca3af;border-top:1px solid #e5e7eb; }
  @media print { .client-header,.client-sidebar,.page-header,.invoice-a4__action { display:none!important; } .client-main,.client-content { margin:0!important;padding:0!important; } .invoice-a4 { box-shadow:none;border-radius:0; } }
</style>

<div class="page-header">
  <div class="page-header__left"><h1>Checkout</h1><p>Konfirmasi dan pembayaran pesanan</p></div>
</div>

<div class="invoice-a4">
  <div class="invoice-a4__inner">
    <div class="invoice-a4__header">
      <div class="invoice-a4__vendor">
        <h2>{{ config('company.name') }}</h2>
        <p>
          @if(config('company.address')){{ config('company.address') }}<br>@endif
          @if(config('company.npwp'))NPWP: {{ config('company.npwp') }}<br>@endif
          @if(config('company.phone'))Telp: {{ config('company.phone') }}<br>@endif
          @if(config('company.email'))Email: {{ config('company.email') }}@endif
        </p>
      </div>
      <div class="invoice-a4__title">
        <h1>{{ $settings['invoice_header'] ?? 'INVOICE' }}</h1>
        <p># {{ 'INV-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -5)) }}</p>
      </div>
    </div>

    @php
      $rate = config('company.tax_rate', 11);
      $monthlyPrice = $pricingPlan->price['bulanan'] ?? 0;
    @endphp

    <div class="duration-selector" style="margin-bottom:24px;padding:20px;background:#f8fafc;border-radius:12px;border:1px solid #e5e7eb;">
      <label style="font-size:13px;font-weight:600;display:block;margin-bottom:12px;color:var(--text);">Pilih Durasi Berlangganan</label>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;">
        <label class="duration-option" data-multiplier="1" style="display:flex;align-items:center;gap:10px;padding:14px;border:2px solid var(--primary);border-radius:10px;cursor:pointer;background:#fff;transition:all.15s;">
          <input type="radio" name="duration" value="1month" checked style="accent-color:var(--primary);">
          <div>
            <div style="font-weight:600;font-size:14px;">1 Bulan</div>
            <div style="font-size:13px;color:var(--primary);font-weight:700;">Rp {{ number_format($monthlyPrice * 1, 0, ',', '.') }} <span style="font-weight:400;color:var(--text2);font-size:11px;">/bulan</span></div>
          </div>
        </label>
        <label class="duration-option" data-multiplier="6" style="display:flex;align-items:center;gap:10px;padding:14px;border:2px solid #e5e7eb;border-radius:10px;cursor:pointer;background:#fff;transition:all.15s;">
          <input type="radio" name="duration" value="6month" style="accent-color:var(--primary);">
          <div>
            <div style="font-weight:600;font-size:14px;">6 Bulan</div>
            <div style="font-size:13px;color:var(--text);font-weight:700;">Rp {{ number_format($monthlyPrice * 6, 0, ',', '.') }} <span style="font-weight:400;color:var(--text2);font-size:11px;">/6 bulan</span></div>
          </div>
        </label>
        <label class="duration-option" data-multiplier="12" style="display:flex;align-items:center;gap:10px;padding:14px;border:2px solid #e5e7eb;border-radius:10px;cursor:pointer;background:#fff;transition:all.15s;">
          <input type="radio" name="duration" value="12month" style="accent-color:var(--primary);">
          <div>
            <div style="font-weight:600;font-size:14px;">1 Tahun</div>
            <div style="font-size:13px;color:var(--text);font-weight:700;">Rp {{ number_format($monthlyPrice * 12, 0, ',', '.') }} <span style="font-weight:400;color:var(--text2);font-size:11px;">/tahun</span></div>
          </div>
        </label>
      </div>
    </div>

    <div class="invoice-a4__info">
      <div class="invoice-a4__bill">
        <h4>Kepada</h4>
        <p>
          <strong>{{ Auth::user()->name }}</strong><br>
          {{ Auth::user()->email }}<br>
          @if(Auth::user()->phone){{ Auth::user()->phone }}@endif
        </p>
      </div>
      <div class="invoice-a4__meta">
        <h4>Detail</h4>
        <p>
          Tanggal: {{ now()->format('d M Y') }}<br>
          Periode: <span id="periodLabel">1 Bulan</span><br>
          Status: <span style="color:#d97706;">Menunggu Pembayaran</span>
        </p>
      </div>
    </div>

    <table class="invoice-a4__table">
      <thead>
        <tr><th>Deskripsi</th><th style="text-align:center;">Qty</th><th>Harga</th><th>Subtotal</th></tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>{{ $pricingPlan->name }}</strong><br><small style="color:#6b7280;">{{ $pricingPlan->tagline }}</small></td>
          <td style="text-align:center;">1</td>
          <td id="unitPriceDisplay">Rp {{ number_format($monthlyPrice * 1, 0, ',', '.') }}</td>
          <td id="subtotalDisplay">Rp {{ number_format($monthlyPrice * 1, 0, ',', '.') }}</td>
        </tr>
      </tbody>
    </table>

    <div class="invoice-a4__totals">
      <table>
        <tr><td>DPP (Dasar Pengenaan Pajak)</td><td id="dppDisplay">Rp {{ number_format(round($monthlyPrice * 1 / (1 + $rate / 100)), 0, ',', '.') }}</td></tr>
        <tr><td>PPN {{ $rate }}%</td><td id="taxDisplay">Rp {{ number_format(($monthlyPrice * 1) - round($monthlyPrice * 1 / (1 + $rate / 100)), 0, ',', '.') }}</td></tr>
        <tr class="sep"><td>Total <small style="color:#6b7280;font-weight:400;">(Sudah termasuk PPN)</small></td><td id="totalDisplay">Rp {{ number_format($monthlyPrice * 1, 0, ',', '.') }}</td></tr>
        <tr class="grand"><td>Total Dibayarkan</td><td id="grandTotalDisplay">Rp {{ number_format($monthlyPrice * 1, 0, ',', '.') }}</td></tr>
      </table>
    </div>

    @if(!empty($settings['invoice_terms']))
    <div class="invoice-a4__terms">
      <strong>Syarat & Ketentuan:</strong><br>
      {{ $settings['invoice_terms'] }}
    </div>
    @endif

    @if(!empty($settings['invoice_bank_name']) && !empty($settings['invoice_bank_account']))
    <div class="invoice-a4__terms">
      <strong>Pembayaran melalui:</strong><br>
      {{ $settings['invoice_bank_name'] }} — {{ $settings['invoice_bank_account'] }}<br>
      a.n. {{ $settings['invoice_bank_holder'] ?? config('company.name') }}
    </div>
    @endif
  </div>

  <div class="invoice-a4__action">
    <form method="POST" action="{{ route('client.orders.store', $pricingPlan) }}" id="checkoutForm">
      @csrf
      <input type="hidden" name="duration" id="durationInput" value="1month">
      <button type="submit" class="btn btn--primary" style="padding:14px 48px;font-size:16px;">
        <i class="fa-solid fa-credit-card"></i> Lanjutkan ke Pembayaran
      </button>
    </form>
    <p style="margin-top:8px;font-size:12px;color:#9ca3af;">Pembayaran diproses secara aman melalui Midtrans.</p>
  </div>

  <div class="invoice-a4__footer">
    {{ $settings['invoice_footer'] ?? 'Terima kasih telah mempercayakan layanan kepada kami.' }}<br>
    {{ config('company.name') }} &mdash; Vendor Layanan Digital Nagari
  </div>
</div>

@push('scripts')
<script>
const monthlyPrice = {{ $monthlyPrice }};
const taxRate = {{ $rate }};

document.querySelectorAll('.duration-option').forEach(opt => {
  const radio = opt.querySelector('input[type="radio"]');
  radio.addEventListener('change', function() {
    document.querySelectorAll('.duration-option').forEach(o => {
      o.style.borderColor = '#e5e7eb';
    });
    opt.style.borderColor = 'var(--primary)';

    document.getElementById('durationInput').value = this.value;

    const multiplier = parseInt(opt.dataset.multiplier);
    const price = monthlyPrice * multiplier;
    const subtotal = Math.round(price / (1 + taxRate / 100));
    const tax = price - subtotal;

    const fmt = n => 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    document.getElementById('unitPriceDisplay').textContent = fmt(price);
    document.getElementById('subtotalDisplay').textContent = fmt(price);
    document.getElementById('dppDisplay').textContent = fmt(subtotal);
    document.getElementById('taxDisplay').textContent = fmt(tax);
    document.getElementById('totalDisplay').textContent = fmt(price);
    document.getElementById('grandTotalDisplay').textContent = fmt(price);

    const labels = { '1month': '1 Bulan', '6month': '6 Bulan', '12month': '1 Tahun' };
    document.getElementById('periodLabel').textContent = labels[this.value] || '1 Bulan';
  });
});
</script>
@endpush
@endsection
