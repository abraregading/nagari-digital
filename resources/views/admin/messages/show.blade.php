@extends('admin.layouts.app')
@section('title', 'Detail Pesan')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Detail Pesan</h1></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.messages.index') }}" class="btn btn--secondary btn--sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
  </div>
</div>
<div class="card">
  <div class="card__body">
    @if(!$message->is_read)
    <form method="POST" action="{{ route('admin.messages.read', $message) }}" style="margin-bottom:16px;">
      @csrf @method('PATCH')
      <button type="submit" class="btn btn--primary btn--sm">Tandai Sudah Dibaca</button>
    </form>
    @endif
    <table style="width:100%;">
      <tr><td style="padding:8px 12px;width:150px;font-weight:600;">Nama</td><td style="padding:8px 12px;">{{ $message->name }}</td></tr>
      <tr><td style="padding:8px 12px;font-weight:600;">Email</td><td style="padding:8px 12px;">{{ $message->email ?: '-' }}</td></tr>
      <tr><td style="padding:8px 12px;font-weight:600;">WhatsApp</td><td style="padding:8px 12px;">{{ $message->whatsapp }}</td></tr>
      <tr><td style="padding:8px 12px;font-weight:600;">Nagari</td><td style="padding:8px 12px;">{{ $message->nagari }}</td></tr>
      <tr><td style="padding:8px 12px;font-weight:600;">Paket</td><td style="padding:8px 12px;">{{ $message->paket ?: 'Tidak disebutkan' }}</td></tr>
      <tr><td style="padding:8px 12px;font-weight:600;">Tanggal</td><td style="padding:8px 12px;">{{ $message->created_at->format('d M Y H:i') }}</td></tr>
      <tr><td style="padding:8px 12px;font-weight:600;">Pesan</td><td style="padding:8px 12px;white-space:pre-wrap;">{{ $message->pesan ?: '(tidak ada pesan)' }}</td></tr>
    </table>
  </div>
</div>
@endsection
