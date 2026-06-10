@extends('admin.layouts.app')
@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>{{ isset($product) ? 'Edit' : 'Tambah' }} Produk</h1></div>
</div>
<div class="card">
  <div class="card__body">
    <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}">
      @csrf @if(isset($product)) @method('PUT') @endif
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div><label style="font-size:13px;font-weight:500;">Ikon</label><input type="text" name="icon" value="{{ $product->icon ?? 'fa-file-contract' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Judul</label><input type="text" name="title" value="{{ $product->title ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div style="grid-column:1/-1;"><label style="font-size:13px;font-weight:500;">Deskripsi</label><textarea name="description" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;min-height:80px;">{{ $product->description ?? '' }}</textarea></div>
        <div><label style="font-size:13px;font-weight:500;">Link</label><input type="text" name="link" value="{{ $product->link ?? 'fitur#pelayanan' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Warna</label><select name="color" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;">
          <option value="green" {{ (isset($product) && $product->color == 'green') ? 'selected' : '' }}>Green</option>
          <option value="blue" {{ (isset($product) && $product->color == 'blue') ? 'selected' : '' }}>Blue</option>
          <option value="purple" {{ (isset($product) && $product->color == 'purple') ? 'selected' : '' }}>Purple</option>
          <option value="rose" {{ (isset($product) && $product->color == 'rose') ? 'selected' : '' }}>Rose</option>
          <option value="teal" {{ (isset($product) && $product->color == 'teal') ? 'selected' : '' }}>Teal</option>
        </select></div>
        <div><label style="font-size:13px;font-weight:500;">Urutan</label><input type="number" name="order" value="{{ $product->order ?? '0' }}" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div style="grid-column:1/-1;"><label style="font-size:13px;font-weight:500;">Fitur (satu per baris)</label><textarea name="features" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;min-height:100px;">{{ isset($product) ? implode("\n", $product->features) : '' }}</textarea></div>
      </div>
      <button type="submit" class="btn btn--primary" style="margin-top:20px;">Simpan</button>
      <a href="{{ route('admin.products.index') }}" class="btn btn--secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
