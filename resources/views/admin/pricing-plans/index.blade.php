@extends('admin.layouts.app')
@section('title', 'Harga & Paket')
@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Harga & Paket</h1><p>Kelola paket harga langganan</p></div>
</div>
@foreach($plans as $plan)
<div class="card" style="margin-bottom:20px;">
  <div class="card__header"><h3><i class="fa-solid {{ $plan->icon }}"></i> {{ $plan->name }} @if($plan->popular) <span style="font-size:11px;background:#fef3c7;color:#92400e;padding:2px 8px;border-radius:999px;">POPULER</span> @endif</h3></div>
  <div class="card__body">
    <form method="POST" action="{{ route('admin.pricing-plans.update', $plan) }}">
      @csrf @method('PUT')
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
        <div><label style="font-size:13px;font-weight:500;">Nama Paket</label><input type="text" name="name" value="{{ $plan->name }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
        <div><label style="font-size:13px;font-weight:500;">Tagline</label><input type="text" name="tagline" value="{{ $plan->tagline }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;"></div>
      </div>

      <div style="margin-bottom:16px;">
        <label style="font-size:13px;font-weight:500;display:block;margin-bottom:4px;">Harga per Bulan (Rp)</label>
        <input type="number" name="price_bulanan" value="{{ $plan->price['bulanan'] }}" class="form-control" required style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;">
        <p style="font-size:11px;color:var(--text2);margin-top:4px;">
          <i class="fa-solid fa-calculator"></i> Harga 6 bulan = ×6 &middot; 1 tahun = ×12 dari harga bulanan (otomatis)
        </p>
      </div>

      <div style="margin-bottom:16px;">
        <label style="font-size:13px;font-weight:500;">Fitur (format: [x] untuk termasuk, [ ] untuk tidak termasuk)</label>
        <textarea name="features" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;margin-top:4px;min-height:150px;font-family:monospace;font-size:12px;">@foreach($plan->features as $f){{ ($f->included ? '[x]' : '[ ]') }} {{ $f->text }}
@endforeach</textarea>
      </div>
      <button type="submit" class="btn btn--primary">Simpan Paket</button>
    </form>
    <form method="POST" action="{{ route('admin.pricing-plans.toggle', $plan) }}" style="display:inline;">
      @csrf
      <button type="submit" class="btn btn--secondary" style="margin-top:8px;">{{ $plan->popular ? 'Nonaktifkan Popular' : 'Jadikan Popular' }}</button>
    </form>
  </div>
</div>
@endforeach
@endsection
