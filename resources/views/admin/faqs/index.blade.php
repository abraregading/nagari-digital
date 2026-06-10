@extends('admin.layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>FAQ</h1><p>Kelola pertanyaan yang sering diajukan</p></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.faqs.create') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-plus"></i> Tambah</a>
  </div>
</div>
<div class="card">
  <div class="card__body">
    <table style="width:100%;border-collapse:collapse;">
      <thead><tr style="background:#f9fafb;"><th style="padding:10px 16px;"></th><th style="padding:10px 16px;text-align:left;">Pertanyaan</th><th style="padding:10px 16px;text-align:left;">Jawaban</th><th style="padding:10px 16px;text-align:center;">Aksi</th></tr></thead>
      <tbody>
        @foreach($faqs as $faq)
        <tr style="border-top:1px solid #e5e7eb;">
          <td style="padding:10px 16px;"><i class="fa-solid {{ $faq->icon }}" style="color:#0E8A4A;"></i></td>
          <td style="padding:10px 16px;"><strong>{{ $faq->question }}</strong></td>
          <td style="padding:10px 16px;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{!! strip_tags($faq->answer) !!}</td>
          <td style="padding:10px 16px;text-align:center;">
            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn--ghost btn--sm btn--icon"><i class="fa-solid fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" style="display:inline;" onsubmit="return confirm('Hapus?')">
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
