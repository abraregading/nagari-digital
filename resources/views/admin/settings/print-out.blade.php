@extends('admin.layouts.app')

@section('title', 'Pengaturan Invoice')

@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Pengaturan Invoice / Print-out</h1><p>Kelola tampilan invoice cetak untuk transaksi client</p></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.settings.index') }}" class="btn btn--secondary btn--sm"><i class="fa-solid fa-gear"></i> Pengaturan Website</a>
  </div>
</div>

<div style="max-width:720px;">
  <form method="POST" action="{{ route('admin.settings.print-out.update') }}">
    @csrf

    <div class="card" style="margin-bottom:20px;">
      <div class="card__header"><h3>Header Invoice</h3></div>
      <div class="card__body">
        <div class="form-group">
          <label class="form-label">Judul Invoice</label>
          <input type="text" name="invoice_header" class="form-input" value="{{ $settings['invoice_header'] ?? 'INVOICE' }}" placeholder="INVOICE">
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px;">
      <div class="card__header"><h3>Informasi Bank</h3></div>
      <div class="card__body">
        <div class="form-group">
          <label class="form-label">Nama Bank</label>
          <input type="text" name="invoice_bank_name" class="form-input" value="{{ $settings['invoice_bank_name'] ?? '' }}" placeholder="Bank Mandiri">
        </div>
        <div class="form-group">
          <label class="form-label">Nomor Rekening</label>
          <input type="text" name="invoice_bank_account" class="form-input" value="{{ $settings['invoice_bank_account'] ?? '' }}" placeholder="123-00-XXXXXXXXX">
        </div>
        <div class="form-group">
          <label class="form-label">Atas Nama</label>
          <input type="text" name="invoice_bank_holder" class="form-input" value="{{ $settings['invoice_bank_holder'] ?? '' }}" placeholder="PT PERKASA GADING MEDIA">
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px;">
      <div class="card__header"><h3>Syarat & Ketentuan</h3></div>
      <div class="card__body">
        <div class="form-group">
          <label class="form-label">Syarat & Ketentuan</label>
          <textarea name="invoice_terms" class="form-input" rows="4" placeholder="Pembayaran harus dilunasi sesuai nominal yang tertera.">{{ $settings['invoice_terms'] ?? '' }}</textarea>
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px;">
      <div class="card__header"><h3>Footer Invoice</h3></div>
      <div class="card__body">
        <div class="form-group">
          <label class="form-label">Teks Footer</label>
          <textarea name="invoice_footer" class="form-input" rows="2" placeholder="Terima kasih telah mempercayakan layanan kepada kami.">{{ $settings['invoice_footer'] ?? '' }}</textarea>
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px;">
      <div class="card__header"><h3>Tanda Tangan</h3></div>
      <div class="card__body">
        <div class="form-group">
          <label class="form-label">Teks Tanda Tangan</label>
          <textarea name="invoice_signatory" class="form-input" rows="3" placeholder="Hormat kami,&#10;PT PERKASA GADING MEDIA">{{ $settings['invoice_signatory'] ?? '' }}</textarea>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn--primary"><i class="fa-solid fa-save"></i> Simpan Pengaturan</button>
  </form>
</div>

<style>
  .form-group { margin-bottom:16px; }
  .form-label { display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px; }
  .form-input { width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-size:14px;color:#374151;background:#fff;transition:border-color .2s; }
  .form-input:focus { outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgba(37,99,235,.1); }
  textarea.form-input { resize:vertical; }
</style>
@endsection
