<div class="hero__content reveal">
    <span class="hero__badge">{{ $settings['hero_badge'] ?? 'Platform #1 Digitalisasi Nagari di Indonesia' }}</span>
    <h1 class="hero__title">{!! $settings['hero_title'] ?? 'Solusi Digital <span class="highlight">Terintegrasi</span> untuk Pemerintahan Nagari' !!}</h1>
    <p class="hero__subtitle">{{ $settings['hero_subtitle'] ?? 'Kelola administrasi, data penduduk, pelayanan kependudukan, posyandu, dan website Nagari Anda dalam satu platform yang mudah dan modern.' }}</p>
    <div class="hero__actions">
        <a href="{{ route($settings['hero_primary_btn_link'] ?? 'harga') }}" class="btn btn--primary btn--lg">
            <i class="fa-solid {{ $settings['hero_primary_btn_icon'] ?? 'fa-rocket' }}"></i>
            {{ $settings['hero_primary_btn_text'] ?? 'Lihat Paket Harga' }}
        </a>
        <a href="{{ $settings['hero_secondary_btn_link'] ?? 'https://kuamangalai-ug.nagaridigital.web.id/' }}" target="_blank" class="btn btn--outline-white btn--lg">
            <i class="fa-solid {{ $settings['hero_secondary_btn_icon'] ?? 'fa-eye' }}"></i>
            {{ $settings['hero_secondary_btn_text'] ?? 'Lihat Demo' }}
        </a>
    </div>
</div>
<div class="hero__visual reveal">
    <div class="hero__dashboard-preview">
        <div class="hero__mockup">
            
            <div class="hero__mockup-body">
                <div class="hero__mockup-sidebar"></div>
                <div class="hero__mockup-content">
                    <div class="hero__mockup-line hero__mockup-line--short"></div>
                    <div class="hero__mockup-line"></div>
                    <div class="hero__mockup-line"></div>
                    <div class="hero__mockup-grid">
                        <div class="hero__mockup-card"></div>
                        <div class="hero__mockup-card"></div>
                        <div class="hero__mockup-card"></div>
                        <div class="hero__mockup-card"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
