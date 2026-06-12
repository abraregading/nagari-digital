@extends('client.layouts.app')

@section('title', 'Ubah Paket Pesanan')

@section('content')
<div class="page-header">
  <div class="page-header__left">
    <h1>Ubah Paket Pesanan</h1>
    <p>Invoice: <strong>{{ $order->invoice }}</strong></p>
  </div>
  <div class="page-header__actions">
    <a href="{{ route('client.orders.show', $order) }}" class="btn btn--secondary btn--sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
  </div>
</div>

@if(session('error'))
<div class="alert alert--error">{{ session('error') }}</div>
@endif

<div class="card" style="max-width:600px;">
  <div class="card__header"><h3>Pilih Paket Baru</h3></div>
  <div class="card__body">
    <p style="font-size:13px;color:var(--text2);margin-bottom:16px;">Pesanan saat ini: <strong>{{ $order->pricingPlan->name ?? '-' }}</strong> (Rp {{ number_format($order->amount, 0, ',', '.') }})</p>

    <form method="POST" action="{{ route('client.orders.update', $order) }}">
      @csrf
      @method('PUT')

      <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:20px;">
        @foreach($pricingPlans as $plan)
        <label style="display:flex;align-items:center;gap:12px;padding:16px;border:2px solid #e5e7eb;border-radius:10px;cursor:pointer;transition:all .15s;{{ $order->pricing_plan_id === $plan->id ? 'border-color:var(--primary);background:#f0f5ff;' : '' }}"
          onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor=this.querySelector('input').checked ? 'var(--primary)' : '#e5e7eb'"
          onclick="this.querySelector('input').checked=true;this.style.borderColor='var(--primary)';this.style.background='#f0f5ff';document.querySelectorAll('label[onclick]').forEach(l=>{if(l!==this){l.style.borderColor='#e5e7eb';l.style.background=''}})">
          <input type="radio" name="pricing_plan_id" value="{{ $plan->id }}" {{ $order->pricing_plan_id === $plan->id ? 'checked' : '' }} style="accent-color:var(--primary);">
          <div>
            <div style="font-weight:600;">{{ $plan->name }}</div>
            <div style="font-size:13px;color:var(--text2);">{{ $plan->tagline }}</div>
            <div style="font-size:13px;color:var(--text2);margin-top:2px;">
              @php $m = $plan->price['bulanan'] ?? 0; @endphp
              1 bln: Rp {{ number_format($m * 1, 0, ',', '.') }}
              &middot; 6 bln: Rp {{ number_format($m * 6, 0, ',', '.') }}
              &middot; 1 thn: Rp {{ number_format($m * 12, 0, ',', '.') }}
            </div>
          </div>
        </label>
        @endforeach
      </div>

      <div style="margin-bottom:20px;">
        <label style="font-size:13px;font-weight:600;display:block;margin-bottom:8px;">Pilih Durasi</label>
        <div style="display:flex;gap:8px;">
          @php $currentDuration = $order->duration ?? '1month'; @endphp
          <label style="flex:1;text-align:center;padding:10px;border:2px solid {{ $currentDuration === '1month' ? 'var(--primary)' : '#e5e7eb' }};border-radius:8px;cursor:pointer;background:{{ $currentDuration === '1month' ? '#f0f5ff' : '#fff' }};">
            <input type="radio" name="duration" value="1month" {{ $currentDuration === '1month' ? 'checked' : '' }} style="accent-color:var(--primary);" onchange="this.closest('label').style.borderColor='var(--primary)';this.closest('label').style.background='#f0f5ff';document.querySelectorAll('label:has(input[name=duration])').forEach(l=>{if(l!==this.closest('label')){l.style.borderColor='#e5e7eb';l.style.background='#fff'}})">
            <div style="font-size:13px;font-weight:500;">1 Bulan</div>
          </label>
          <label style="flex:1;text-align:center;padding:10px;border:2px solid {{ $currentDuration === '6month' ? 'var(--primary)' : '#e5e7eb' }};border-radius:8px;cursor:pointer;background:{{ $currentDuration === '6month' ? '#f0f5ff' : '#fff' }};">
            <input type="radio" name="duration" value="6month" {{ $currentDuration === '6month' ? 'checked' : '' }} style="accent-color:var(--primary);" onchange="this.closest('label').style.borderColor='var(--primary)';this.closest('label').style.background='#f0f5ff';document.querySelectorAll('label:has(input[name=duration])').forEach(l=>{if(l!==this.closest('label')){l.style.borderColor='#e5e7eb';l.style.background='#fff'}})">
            <div style="font-size:13px;font-weight:500;">6 Bulan</div>
          </label>
          <label style="flex:1;text-align:center;padding:10px;border:2px solid {{ $currentDuration === '12month' ? 'var(--primary)' : '#e5e7eb' }};border-radius:8px;cursor:pointer;background:{{ $currentDuration === '12month' ? '#f0f5ff' : '#fff' }};">
            <input type="radio" name="duration" value="12month" {{ $currentDuration === '12month' ? 'checked' : '' }} style="accent-color:var(--primary);" onchange="this.closest('label').style.borderColor='var(--primary)';this.closest('label').style.background='#f0f5ff';document.querySelectorAll('label:has(input[name=duration])').forEach(l=>{if(l!==this.closest('label')){l.style.borderColor='#e5e7eb';l.style.background='#fff'}})">
            <div style="font-size:13px;font-weight:500;">1 Tahun</div>
          </label>
        </div>
      </div>

      @error('pricing_plan_id')
      <p style="color:#dc2626;font-size:13px;margin-bottom:12px;">{{ $message }}</p>
      @enderror

      <div style="display:flex;gap:8px;">
        <button type="submit" class="btn btn--primary"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
        <a href="{{ route('client.orders.show', $order) }}" class="btn btn--secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection