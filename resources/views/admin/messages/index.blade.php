@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Pesan Masuk</h1><p>Daftar pesan dari formulir kontak</p></div>
</div>
<div class="card">
  <div class="card__body">
    <table style="width:100%;border-collapse:collapse;">
      <thead><tr style="background:#f9fafb;"><th style="padding:10px 16px;"></th><th style="padding:10px 16px;text-align:left;">Nama</th><th style="padding:10px 16px;text-align:left;">Nagari</th><th style="padding:10px 16px;text-align:left;">WhatsApp</th><th style="padding:10px 16px;text-align:left;">Paket</th><th style="padding:10px 16px;text-align:left;">Tanggal</th><th style="padding:10px 16px;text-align:center;">Aksi</th></tr></thead>
      <tbody>
        @foreach($messages as $msg)
        <tr style="{{ $msg->is_read ? '' : 'background:#f0fdf4;' }}border-top:1px solid #e5e7eb;">
          <td style="padding:10px 16px;">{!! $msg->is_read ? '<i class="fa-solid fa-envelope-open" style="color:#9ca3af;"></i>' : '<i class="fa-solid fa-envelope" style="color:#0E8A4A;"></i>' !!}</td>
          <td style="padding:10px 16px;"><strong>{{ $msg->name }}</strong></td>
          <td style="padding:10px 16px;">{{ $msg->nagari }}</td>
          <td style="padding:10px 16px;">{{ $msg->whatsapp }}</td>
          <td style="padding:10px 16px;">{{ $msg->paket ?: '-' }}</td>
          <td style="padding:10px 16px;">{{ $msg->created_at->format('d M Y H:i') }}</td>
          <td style="padding:10px 16px;text-align:center;">
            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn--ghost btn--sm btn--icon"><i class="fa-solid fa-eye"></i></a>
            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" style="display:inline;" onsubmit="return confirm('Hapus?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn--ghost btn--sm btn--icon" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
