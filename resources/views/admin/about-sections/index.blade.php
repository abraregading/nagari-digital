@extends('admin.layouts.app')
@section('title', 'Tentang Kami')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Tentang Kami</h1><p>Kelola halaman tentang kami</p></div>
</div>
@foreach($sections as $section)
<div class="card" style="margin-bottom:20px;">
  <div class="card__header"><h3>{{ ucfirst(str_replace('_', ' ', $section->type)) }}</h3></div>
  <div class="card__body">
    <form method="POST" action="{{ route('admin.about-sections.update', $section) }}">
      @csrf @method('PUT')
      @if($section->type === 'story_paragraphs')
        <textarea name="content" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;min-height:200px;">{{ is_array($section->content) ? implode("\n\n", $section->content) : $section->content }}</textarea>
        <p style="font-size:11px;color:var(--text2);margin-top:4px;">Pisahkan paragraf dengan baris kosong.</p>
      @elseif($section->type === 'vision' || $section->type === 'story_highlight')
        <textarea name="content" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;min-height:120px;">{{ $section->content }}</textarea>
      @elseif($section->type === 'missions' || $section->type === 'values' || $section->type === 'timeline')
        <p style="font-size:13px;color:var(--text2);">Konten ini dikelola dalam format JSON. Edit melalui database langsung.</p>
        <textarea name="content" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;min-height:200px;font-family:monospace;font-size:12px;">{{ json_encode($section->content, JSON_PRETTY_PRINT) }}</textarea>
      @endif
      <button type="submit" class="btn btn--primary" style="margin-top:12px;">Simpan</button>
    </form>
  </div>
</div>
@endforeach
@endsection
