@extends('admin.layouts.app')
@section('title', 'Testimonial')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Testimonial</h1><p>Kelola testimonial pelanggan</p></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-plus"></i> Tambah</a>
  </div>
</div>
<div class="card">
  <div class="card__body">
    <table style="width:100%;border-collapse:collapse;">
      <thead><tr style="background:#f9fafb;"><th style="padding:10px 16px;"></th><th style="padding:10px 16px;text-align:left;">Nama</th><th style="padding:10px 16px;text-align:left;">Role</th><th style="padding:10px 16px;text-align:left;">Nagari</th><th style="padding:10px 16px;text-align:center;">Rating</th><th style="padding:10px 16px;text-align:center;">Aksi</th></tr></thead>
      <tbody>
        @foreach($testimonials as $t)
        <tr style="border-top:1px solid #e5e7eb;">
          <td style="padding:10px 16px;"><div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#0E8A4A,#22C55E);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:12px;">{{ $t->avatar ?: substr($t->name, 0, 2) }}</div></td>
          <td style="padding:10px 16px;"><strong>{{ $t->name }}</strong></td>
          <td style="padding:10px 16px;">{{ $t->role }}</td>
          <td style="padding:10px 16px;">{{ $t->village }}</td>
          <td style="padding:10px 16px;text-align:center;">{{ str_repeat('★', floor($t->rating)) }}{{ $t->rating % 1 ? '½' : '' }}</td>
          <td style="padding:10px 16px;text-align:center;">
            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn--ghost btn--sm btn--icon"><i class="fa-solid fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" style="display:inline;" onsubmit="return confirm('Hapus?')">
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
