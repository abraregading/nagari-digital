@extends('admin.layouts.app')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Tambah Testimonial')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>{{ isset($testimonial) ? 'Edit' : 'Tambah' }} Testimonial</h1></div>
</div>
<div class="card">
  <div class="card__body">
    <form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
      @csrf @if(isset($testimonial)) @method('PUT') @endif
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div><label style="font-size:13px;font-weight:500;">Nama</label><input type="text" name="name" value="{{ $testimonial->name ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Role / Jabatan</label><input type="text" name="role" value="{{ $testimonial->role ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Nagari</label><input type="text" name="village" value="{{ $testimonial->village ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Rating (1-5)</label><input type="number" step="0.5" min="0" max="5" name="rating" value="{{ $testimonial->rating ?? '5' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div style="grid-column:1/-1;"><label style="font-size:13px;font-weight:500;">Testimoni</label><textarea name="text" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;min-height:100px;">{{ $testimonial->text ?? '' }}</textarea></div>
      </div>
      <button type="submit" class="btn btn--primary" style="margin-top:20px;">Simpan</button>
      <a href="{{ route('admin.testimonials.index') }}" class="btn btn--secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
