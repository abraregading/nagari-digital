<section class="demo section--dark" id="demo">
    <div class="demo__glow"></div>
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Coba Gratis</span>
            <h2>Coba Demo Sebelum Membeli</h2>
            <p>Rasakan langsung kemudahan dan kecanggihan setiap aplikasi Nagari Digital. Akses demo gratis tanpa komitmen — lihat sendiri bagaimana platform kami bekerja.</p>
        </div>

        <div class="demo__register-box reveal-scale">
            <div class="demo__register-content">
                <div class="demo__register-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div class="demo__register-text">
                    <h3>Daftar Akun Demo Gratis</h3>
                    <p>Buat akun demo untuk mengakses semua 5 aplikasi Nagari Digital secara gratis. Tidak perlu kartu kredit, tidak ada batas waktu trial.</p>
                </div>
                <a href="#" class="btn btn--primary btn--lg demo__register-btn" id="demoRegisterBtn">
                    <i class="fa-solid fa-rocket"></i> Daftar Demo Sekarang
                </a>
            </div>
        </div>

        <div class="demo__grid stagger">
            @php
            $demoApps = [
                ['icon' => 'fa-file-contract', 'color' => 'green', 'title' => 'Pelayanan Kependudukan', 'desc' => 'Coba langsung proses pembuatan surat, tracking pengajuan, dan manajemen data kependudukan.',
                 'features' => ['Buat surat contoh (KK, KTP, Akta)', 'Lihat dashboard pelayanan', 'Tracking status pengajuan']],
                ['icon' => 'fa-map-location-dot', 'color' => 'blue', 'title' => 'Aplikasi Jorong', 'desc' => 'Jelajahi dashboard jorong, manajemen data wilayah, dan sinkronisasi dengan sistem Nagari.',
                 'features' => ['Dashboard data jorong', 'Kelola penduduk per jorong', 'Laporan periodik otomatis']],
                ['icon' => 'fa-users-rectangle', 'color' => 'purple', 'title' => 'Pendataan Penduduk', 'desc' => 'Lihat sistem pencatatan penduduk, statistik demografi, dan fitur export laporan.',
                 'features' => ['Input & cari data penduduk', 'Grafik demografi interaktif', 'Export PDF & Excel']],
                ['icon' => 'fa-heart-pulse', 'color' => 'rose', 'title' => 'Aplikasi Posyandu', 'desc' => 'Coba pencatatan KMS digital, monitoring balita & lansia, dan jadwal imunisasi otomatis.',
                 'features' => ['KMS digital & grafik tumbuh kembang', 'Pencatatan data kesehatan', 'Jadwal & reminder posyandu']],
                ['icon' => 'fa-globe', 'color' => 'teal', 'title' => 'Website Nagari', 'desc' => 'Lihat website Nagari yang sudah berjalan secara langsung — Nagari Kuamang Alai Ujung Gading.',
                 'features' => ['Website resmi fully functional', 'CMS & manajemen konten', 'Responsif di semua device'], 'live' => true],
            ];
            @endphp

            @foreach($demoApps as $demoApp)
            <div class="demo__card reveal">
                <div class="demo__card-header">
                    <div class="demo__card-icon @if($demoApp['color'] !== 'green') demo__card-icon--{{ $demoApp['color'] }} @endif">
                        <i class="fa-solid {{ $demoApp['icon'] }}"></i>
                    </div>
                    <span class="demo__card-badge @if(!empty($demoApp['live'])) demo__card-badge--live @endif">
                        {{ !empty($demoApp['live']) ? 'Live Demo' : 'Demo Tersedia' }}
                    </span>
                </div>
                <h3 class="demo__card-title">{{ $demoApp['title'] }}</h3>
                <p class="demo__card-desc">{{ $demoApp['desc'] }}</p>
                <ul class="demo__card-features">
                    @foreach($demoApp['features'] as $feature)
                    <li><i class="fa-solid fa-play"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
                <div class="demo__card-credentials">
                    @if(!empty($demoApp['live']))
                    <span><i class="fa-solid fa-globe"></i> Live URL:</span>
                    <code>{{ str_replace(['https://', 'http://'], '', $settings['demo_url'] ?? 'kuamangalai-ug.nagaridigital.web.id') }}</code>
                    @else
                    <span><i class="fa-solid fa-key"></i> Demo Login:</span>
                    <code>{{ $settings['demo_email'] ?? 'admin@demo.id' }} / {{ $settings['demo_password'] ?? 'demo1234' }}</code>
                    @endif
                </div>
                @if(!empty($demoApp['live']))
                <a href="{{ $settings['demo_url'] ?? 'https://kuamangalai-ug.nagaridigital.web.id/' }}" class="btn btn--primary demo__card-btn" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Kunjungi Website
                </a>
                @else
                <a href="https://demo-layanan.nagaridigital.web.id/" class="btn btn--primary demo__card-btn" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Demo
                </a>
                @endif
            </div>
            @endforeach
        </div>

        <div class="demo__bottom-cta reveal">
            <p><i class="fa-solid fa-circle-info"></i> Butuh bantuan mengakses demo? Hubungi kami via WhatsApp untuk panduan langkah demi langkah.</p>
            <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6285161839282' }}?text=Halo%2C%20saya%20ingin%20mencoba%20demo%20Nagari%20Digital.%20Bisa%20bantu%20saya%3F" target="_blank" class="btn btn--whatsapp btn--sm">
                <i class="fa-brands fa-whatsapp"></i> Chat untuk Bantuan Demo
            </a>
        </div>
    </div>
</section>
