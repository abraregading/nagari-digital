@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit Item' : 'Tambah Item')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>{{ isset($item) ? 'Edit' : 'Tambah' }}</h1></div>
</div>
<div class="card">
  <div class="card__body">
    <form method="POST" action="{{ isset($item) ? route('admin.why-choose-us.update', $item) : route('admin.why-choose-us.store') }}">
      @csrf @if(isset($item)) @method('PUT') @endif
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div><label style="font-size:13px;font-weight:500;">Ikon</label><input type="text" name="icon" value="{{ $item->icon ?? 'fa-gauge-high' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Judul</label><input type="text" name="title" value="{{ $item->title ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div style="grid-column:1/-1;"><label style="font-size:13px;font-weight:500;">Deskripsi</label><textarea name="description" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;min-height:80px;">{{ $item->description ?? '' }}</textarea></div>
        <div><label style="font-size:13px;font-weight:500;">Urutan</label><input type="number" name="order" value="{{ $item->order ?? '0' }}" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
      </div>
      <button type="submit" class="btn btn--primary" style="margin-top:20px;">Simpan</button>
      <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn--secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
