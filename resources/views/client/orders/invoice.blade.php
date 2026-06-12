<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice {{ $order->invoice }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @page { size: A4; margin: 0; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #f3f4f6; display:flex;justify-content:center;padding:40px; }
    .page { width: 210mm; min-height: 297mm; background: #fff; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,.1); }
    .header { display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:32px;padding-bottom:24px;border-bottom:2px solid #f3f4f6; }
    .vendor h2 { font-size:18px;font-weight:700;color:#111827;margin-bottom:4px; }
    .vendor p { font-size:12px;color:#6b7280;line-height:1.6; }
    .title { text-align:right; }
    .title h1 { font-size:28px;font-weight:800;color:var(--primary,#2563eb);letter-spacing:2px;margin-bottom:2px; }
    .title p { font-size:12px;color:#6b7280; }
    .info { display:flex;justify-content:space-between;margin-bottom:28px;padding-bottom:20px;border-bottom:1px solid #e5e7eb; }
    .bill h4, .meta h4 { font-size:11px;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;font-weight:600;margin-bottom:6px; }
    .bill p, .meta p { font-size:13px;color:#374151;line-height:1.5; }
    .meta { text-align:right; }
    table.items { width:100%;border-collapse:collapse;margin-bottom:24px; }
    table.items th { text-align:left;padding:10px 0;font-size:11px;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;font-weight:600;border-bottom:1px solid #e5e7eb; }
    table.items td { padding:12px 0;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6; }
    table.items td:last-child, table.items th:last-child { text-align:right; }
    .totals { margin-left:auto;width:320px; }
    .totals table { width:100%; }
    .totals td { padding:6px 0;font-size:13px; }
    .totals td:last-child { text-align:right;font-weight:600;white-space:nowrap; }
    .totals .sep td { border-top:2px solid #e5e7eb;padding-top:8px; }
    .totals .grand td { font-size:14px;font-weight:800;color:var(--primary,#2563eb);padding-top:8px; }
    .totals .grand td:last-child { font-size:15px; }
    .terms { margin-top:24px;padding-top:16px;border-top:1px solid #e5e7eb;font-size:11px;color:#6b7280;line-height:1.6; }
    .footer { text-align:center;padding-top:24px;font-size:11px;color:#9ca3af;border-top:1px solid #e5e7eb;margin-top:32px; }
    .btn-print { display:inline-block;padding:10px 24px;background:#2563eb;color:#fff;border:none;border-radius:8px;font-size:14px;cursor:pointer;margin-bottom:24px; }
    .btn-print:hover { background:#1d4ed8; }
    .status-badge { display:inline-block;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600; }
    .status-pending { background:#fef3c7;color:#d97706; }
    .status-paid { background:#dbeafe;color:#2563eb; }
    .status-active { background:#dcfce7;color:#16a34a; }
    .status-cancelled { background:#fef2f2;color:#dc2626; }
    @media print { body { padding:0;background:#fff; } .page { box-shadow:none;padding:40px; } .no-print { display:none!important; } }
  </style>
</head>
<body>
  <div style="text-align:center;margin-bottom:16px;" class="no-print">
    <button class="btn-print" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak / Print</button>
  </div>

  <div class="page">
    <div class="header">
      <div class="vendor">
        <h2>{{ config('company.name') }}</h2>
        <p>
          @if(config('company.address')){{ config('company.address') }}<br>@endif
          @if(config('company.npwp'))NPWP: {{ config('company.npwp') }}<br>@endif
          @if(config('company.phone'))Telp: {{ config('company.phone') }} &middot; @endif
          @if(config('company.email')){{ config('company.email') }}@endif
        </p>
      </div>
      <div class="title">
        <h1>{{ $settings['invoice_header'] ?? 'INVOICE' }}</h1>
        <p># {{ $order->invoice }}</p>
      </div>
    </div>

    <div class="info">
      <div class="bill">
        <h4>Kepada</h4>
        <p>
          <strong>{{ $order->user->name }}</strong><br>
          {{ $order->user->email }}<br>
          @if($order->user->phone){{ $order->user->phone }}@endif
        </p>
      </div>
      <div class="meta">
        <h4>Detail</h4>
        <p>
          Tanggal: {{ $order->created_at->format('d M Y') }}<br>
          Durasi: {{ $order->getDurationLabel() ?: '-' }}<br>
          Status: <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
        </p>
      </div>
    </div>

    <table class="items">
      <thead>
        <tr><th>Deskripsi</th><th style="text-align:center;">Qty</th><th>Harga</th><th>Subtotal</th></tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>{{ $order->pricingPlan->name ?? '-' }}</strong><br><small style="color:#6b7280;">{{ $order->pricingPlan->tagline ?? '' }}</small></td>
          <td style="text-align:center;">1</td>
          <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
          <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
        </tr>
      </tbody>
    </table>

    <div class="totals">
      <table>
        <tr><td>DPP (Dasar Pengenaan Pajak)</td><td>Rp {{ number_format($order->getSubtotal(), 0, ',', '.') }}</td></tr>
        <tr><td>PPN {{ $order->getTaxRate() }}%</td><td>Rp {{ number_format($order->getTaxAmount(), 0, ',', '.') }}</td></tr>
        <tr class="sep"><td>Total <small style="color:#6b7280;font-weight:400;">(include PPN)</small></td><td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td></tr>
        <tr class="grand"><td>Total Dibayarkan</td><td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td></tr>
      </table>
    </div>

    <div class="terms">
      @if(!empty($settings['invoice_terms']))
      <strong>Syarat & Ketentuan:</strong><br>{{ $settings['invoice_terms'] }}<br><br>
      @endif
      @if(!empty($settings['invoice_bank_name']) && !empty($settings['invoice_bank_account']))
      <strong>Pembayaran:</strong><br>
      {{ $settings['invoice_bank_name'] }} — {{ $settings['invoice_bank_account'] }}<br>
      a.n. {{ $settings['invoice_bank_holder'] ?? config('company.name') }}<br><br>
      @endif
      @if(!empty($settings['invoice_signatory']))
      <div style="margin-top:16px;">{!! $settings['invoice_signatory'] !!}</div>
      @endif
    </div>

    <div class="footer">
      {{ $settings['invoice_footer'] ?? 'Terima kasih telah mempercayakan layanan kepada kami.' }}<br>
      {{ config('company.name') }}
    </div>
  </div>
</body>
</html>
