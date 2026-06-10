@extends('admin.layouts.app')
@section('title', 'Kenapa Kami')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Kenapa Kami</h1><p>Kelola alasan memilih Nagari Digital</p></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-plus"></i> Tambah</a>
  </div>
</div>
<div class="card">
  <div class="card__body">
    @foreach($items as $item)
    <div class="card" style="margin-bottom:12px;">
      <div class="card__body" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
        <div style="width:44px;height:44px;background:#dcfce7;color:#16a34a;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;"><i class="fa-solid {{ $item->icon }}"></i></div>
        <div style="flex:1;"><strong style="font-size:14px;">{{ $item->title }}</strong><p style="font-size:12px;color:var(--text2);margin:2px 0 0;">{{ $item->description }}</p></div>
        <div style="display:flex;gap:4px;">
          <a href="{{ route('admin.why-choose-us.edit', $item) }}" class="btn btn--ghost btn--sm btn--icon"><i class="fa-solid fa-pen"></i></a>
          <form method="POST" action="{{ route('admin.why-choose-us.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn--ghost btn--sm btn--icon" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
