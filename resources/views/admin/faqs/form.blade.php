@extends('admin.layouts.app')
@section('title', isset($faq) ? 'Edit FAQ' : 'Tambah FAQ')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>{{ isset($faq) ? 'Edit' : 'Tambah' }} FAQ</h1></div>
</div>
<div class="card">
  <div class="card__body">
    <form method="POST" action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
      @csrf @if(isset($faq)) @method('PUT') @endif
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div><label style="font-size:13px;font-weight:500;">Ikon</label><input type="text" name="icon" value="{{ $faq->icon ?? 'fa-circle-question' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Urutan</label><input type="number" name="order" value="{{ $faq->order ?? '0' }}" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div style="grid-column:1/-1;"><label style="font-size:13px;font-weight:500;">Pertanyaan</label><input type="text" name="question" value="{{ $faq->question ?? '' }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div style="grid-column:1/-1;"><label style="font-size:13px;font-weight:500;">Jawaban (plain text, akan dibungkus &lt;p&gt;)</label><textarea name="answer" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;min-height:150px;">{{ isset($faq) ? strip_tags($faq->answer) : '' }}</textarea></div>
      </div>
      <button type="submit" class="btn btn--primary" style="margin-top:20px;">Simpan</button>
      <a href="{{ route('admin.faqs.index') }}" class="btn btn--secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
