@extends('admin.layouts.app')
@section('title', 'Statistik')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Statistik</h1><p>Kelola angka statistik di halaman utama</p></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.stats.create') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-plus"></i> Tambah</a>
  </div>
</div>
<div class="card">
  <div class="card__body">
    <table style="width:100%;border-collapse:collapse;">
      <thead><tr style="background:#f9fafb;"><th style="padding:10px 16px;text-align:left;">Ikon</th><th style="padding:10px 16px;text-align:left;">Angka</th><th style="padding:10px 16px;text-align:left;">Suffix</th><th style="padding:10px 16px;text-align:left;">Label</th><th style="padding:10px 16px;text-align:center;">Aksi</th></tr></thead>
      <tbody>
        @foreach($stats as $stat)
        <tr style="border-top:1px solid #e5e7eb;">
          <td style="padding:10px 16px;"><i class="fa-solid {{ $stat->icon }}" style="color:#0E8A4A;"></i></td>
          <td style="padding:10px 16px;"><strong>{{ $stat->count }}</strong></td>
          <td style="padding:10px 16px;">{{ $stat->suffix }}</td>
          <td style="padding:10px 16px;">{{ $stat->label }}</td>
          <td style="padding:10px 16px;text-align:center;">
            <a href="{{ route('admin.stats.edit', $stat) }}" class="btn btn--ghost btn--sm btn--icon"><i class="fa-solid fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.stats.destroy', $stat) }}" style="display:inline;" onsubmit="return confirm('Hapus?')">
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
