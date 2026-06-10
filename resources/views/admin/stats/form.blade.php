@extends('admin.layouts.app')
@section('title', isset($stat) ? 'Edit Statistik' : 'Tambah Statistik')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>{{ isset($stat) ? 'Edit' : 'Tambah' }} Statistik</h1></div>
</div>
<div class="card">
  <div class="card__body">
    <form method="POST" action="{{ isset($stat) ? route('admin.stats.update', $stat) : route('admin.stats.store') }}">
      @csrf @if(isset($stat)) @method('PUT') @endif
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div><label style="font-size:13px;font-weight:500;">Ikon (FontAwesome)</label><input type="text" name="icon" value="{{ $stat->icon ?? 'fa-puzzle-piece' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Angka</label><input type="number" step="0.1" name="count" value="{{ $stat->count ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Suffix</label><input type="text" name="suffix" value="{{ $stat->suffix ?? '+' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Label</label><input type="text" name="label" value="{{ $stat->label ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Urutan</label><input type="number" name="order" value="{{ $stat->order ?? '0' }}" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
      </div>
      <button type="submit" class="btn btn--primary" style="margin-top:20px;">Simpan</button>
      <a href="{{ route('admin.stats.index') }}" class="btn btn--secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
