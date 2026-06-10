@extends('admin.layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="page-header">
  <div class="page-header__left"><h1>Homepage</h1><p>Kelola konten halaman utama website</p></div>
</div>

<div class="card">
  <div class="card__header"><h3>Hero Section</h3></div>
  <div class="card__body">
    <form method="POST" action="{{ route('admin.settings.update') }}">
      @csrf
      @php
      $groups = [
        'Hero' => ['hero_badge', 'hero_title', 'hero_subtitle', 'hero_primary_btn_text', 'hero_primary_btn_link', 'hero_primary_btn_icon', 'hero_secondary_btn_text', 'hero_secondary_btn_link', 'hero_secondary_btn_icon'],
        'Profil' => ['site_name', 'tagline', 'logo_icon', 'footer_desc'],
        'Kontak' => ['whatsapp', 'email', 'location', 'social_facebook', 'social_instagram', 'social_youtube'],
        'SEO' => ['seo_description', 'seo_keywords'],
        'Demo' => ['demo_email', 'demo_password', 'demo_url'],
      ];
      $labels = [
        'hero_badge' => 'Hero Badge', 'hero_title' => 'Hero Title (HTML)', 'hero_subtitle' => 'Hero Subtitle',
        'hero_primary_btn_text' => 'Primary Btn Text', 'hero_primary_btn_link' => 'Primary Btn Link (route name)', 'hero_primary_btn_icon' => 'Primary Btn Icon',
        'hero_secondary_btn_text' => 'Secondary Btn Text', 'hero_secondary_btn_link' => 'Secondary Btn Link (URL)', 'hero_secondary_btn_icon' => 'Secondary Btn Icon',
        'site_name' => 'Nama Situs', 'tagline' => 'Tagline', 'logo_icon' => 'Logo Icon (FontAwesome)', 'footer_desc' => 'Footer Description',
        'whatsapp' => 'No. WhatsApp (dengan kode negara)', 'email' => 'Email', 'location' => 'Lokasi',
        'social_facebook' => 'Facebook URL', 'social_instagram' => 'Instagram URL', 'social_youtube' => 'YouTube URL',
        'seo_description' => 'Meta Description', 'seo_keywords' => 'Meta Keywords',
        'demo_email' => 'Demo Email', 'demo_password' => 'Demo Password', 'demo_url' => 'Demo URL',
      ];
      @endphp
      @foreach($groups as $groupName => $fields)
      <table style="width:100%;margin-bottom:20px;">
        <tr><td colspan="2" style="padding:8px 0;"><h4 style="margin:0;color:var(--primary);">{{ $groupName }}</h4></td></tr>
        @foreach($fields as $key)
        <tr>
          <td style="padding:6px 12px;width:250px;"><label for="{{ $key }}" style="font-size:13px;font-weight:500;">{{ $labels[$key] ?? $key }}</label></td>
          <td style="padding:6px 12px;">
            <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}" class="form-control" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;font-size:13px;">
          </td>
        </tr>
        @endforeach
      </table>
      @endforeach
      <button type="submit" class="btn btn--primary">Simpan Semua Pengaturan</button>
    </form>
  </div>
</div>
@endsection
