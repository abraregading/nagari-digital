@extends('admin.layouts.app')
@section('title', 'Produk / Aplikasi')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Produk / Aplikasi</h1><p>Kelola produk aplikasi Nagari Digital</p></div>
  <div class="page-header__actions">
    <a href="{{ route('admin.products.create') }}" class="btn btn--primary btn--sm"><i class="fa-solid fa-plus"></i> Tambah Produk</a>
  </div>
</div>
<div class="card">
  <div class="card__body">
    <table style="width:100%;border-collapse:collapse;">
      <thead><tr style="background:#f9fafb;"><th style="padding:10px 16px;"></th><th style="padding:10px 16px;text-align:left;">Nama</th><th style="padding:10px 16px;text-align:left;">Fitur</th><th style="padding:10px 16px;text-align:left;">Warna</th><th style="padding:10px 16px;text-align:center;">Aksi</th></tr></thead>
      <tbody>
        @foreach($products as $product)
        <tr style="border-top:1px solid #e5e7eb;">
          <td style="padding:10px 16px;"><div style="width:36px;height:36px;background:#dcfce7;color:#16a34a;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="fa-solid {{ $product->icon }}"></i></div></td>
          <td style="padding:10px 16px;"><strong>{{ $product->title }}</strong></td>
          <td style="padding:10px 16px;">{{ count($product->features) }} fitur</td>
          <td style="padding:10px 16px;"><span style="padding:2px 10px;border-radius:999px;font-size:11px;font-weight:500;background:#dcfce7;color:#166534;">{{ $product->color }}</span></td>
          <td style="padding:10px 16px;text-align:center;">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn--ghost btn--sm btn--icon"><i class="fa-solid fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('Hapus?')">
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
