@extends('site.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('site/css/fitur.css') }}">
@endpush

@section('content')
<header class="hero" id="home">
    <div class="fitur-hero__bg-orbs">
        <div class="fitur-hero__orb fitur-hero__orb--1"></div>
        <div class="fitur-hero__orb fitur-hero__orb--2"></div>
        <div class="fitur-hero__orb fitur-hero__orb--3"></div>
    </div>
    <div class="fitur-hero__grid-pattern"></div>

    <div class="fitur-hero__content">
        <div class="fitur-hero__badge">
            <i class="fa-solid fa-puzzle-piece"></i>
            5 Aplikasi Terintegrasi dalam Satu Platform
        </div>
        <h1 class="fitur-hero__title">
            Fitur Lengkap <span class="highlight">Nagari Digital</span>
        </h1>
        <p class="fitur-hero__subtitle">
            Jelajahi semua fitur canggih yang dirancang khusus untuk kebutuhan pemerintahan nagari — mulai dari pelayanan kependudukan, pendataan, hingga website resmi nagari Anda.
        </p>

        <!-- Quick icon links to each app -->
        <div class="fitur-hero__apps">
            <a href="#pelayanan" class="fitur-hero__app-icon">
                <div class="fitur-hero__app-icon-circle">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
                <span>Pelayanan</span>
            </a>
            <a href="#jorong" class="fitur-hero__app-icon">
                <div class="fitur-hero__app-icon-circle">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <span>Dusun/Jorong</span>
            </a>
            <a href="#pendataan" class="fitur-hero__app-icon">
                <div class="fitur-hero__app-icon-circle">
                    <i class="fa-solid fa-users-rectangle"></i>
                </div>
                <span>Pendataan</span>
            </a>
            <a href="#posyandu" class="fitur-hero__app-icon">
                <div class="fitur-hero__app-icon-circle">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
                <span>Posyandu</span>
            </a>
            <a href="#website" class="fitur-hero__app-icon">
                <div class="fitur-hero__app-icon-circle">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <span>Website</span>
            </a>
        </div>
    </div>
</header>

<section class="app-section" id="pelayanan">
    <div class="container">
        <div class="app-section__layout">
            <!-- Text Side -->
            <div class="app-section__info reveal-left">
                <div class="app-section__icon-badge">
                    <div class="app-section__icon-circle">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <span class="app-section__app-name">Aplikasi Pelayanan</span>
                </div>

                <h2 class="app-section__title">Pelayanan Kependudukan Digital</h2>

                <p class="app-section__desc">
                    Modernisasi seluruh proses administrasi kependudukan desa/nagari Anda. Dari pembuatan surat keterangan seperti : Surat Keterangan Domisili, Surat Keterangan Usaha, Surat Keterangan Usaha, dan surat-surat penting lainnya — semuanya bisa diproses secara digital dengan cepat dan akurat.
                </p>
                <p class="app-section__desc">
                    Sistem ini dilengkapi dengan database kependudukan terintegrasi yang memungkinkan petugas desa/nagari untuk memproses permohonan dalam hitungan menit, bukan hari.
                </p>

                <div class="app-section__features stagger">
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-file-lines"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Pembuatan Surat Otomatis</h4>
                            <p>SKU, SKTM, Dan 10+ jenis surat</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-database"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Database Terintegrasi</h4>
                            <p>Data kependudukan terpusat dan selalu sinkron</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Tracking Real-time</h4>
                            <p>Pantau status pengajuan setiap saat</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-pen-ruler"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Template Kustomisasi</h4>
                            <p>Sesuaikan format surat sesuai kebutuhan</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-box-archive"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Arsip Digital</h4>
                            <p>Semua surat tersimpan aman secara digital</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-print"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Cetak Surat Langsung</h4>
                            <p>Print surat resmi langsung dari sistem</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-brands fa-whatsapp"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Notifikasi Modifikasi Melalui Aplikasi</h4>
                            <p>Update status otomatis ke warga via Aplikasi</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-chart-bar"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Laporan Bulanan</h4>
                            <p>Rekap pelayanan otomatis setiap bulan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Mockup Side -->
            <div class="app-mockup reveal-right">
                <div class="app-mockup__float app-mockup__float--tl" style="color: #22c55e;">
                    <i class="fa-solid fa-check-circle"></i> Surat Selesai
                </div>
                <div class="app-mockup__float app-mockup__float--br" style="color: #2563eb;">
                    <i class="fa-solid fa-bell"></i> 3 Pengajuan Baru
                </div>

                <div class="app-mockup__frame">
                    <div class="app-mockup__toolbar">
                        <div class="app-mockup__dot app-mockup__dot--red"></div>
                        <div class="app-mockup__dot app-mockup__dot--yellow"></div>
                        <div class="app-mockup__dot app-mockup__dot--green"></div>
                        <div class="app-mockup__url">
                            <i class="fa-solid fa-lock"></i> nagaridigital.web.id/pelayanan
                        </div>
                    </div>
                    <div class="app-mockup__body">
                        <div class="mockup-header">
                            <div class="mockup-header__title">
                                <i class="fa-solid fa-file-contract"></i>
                                <span>Pelayanan Kependudukan</span>
                            </div>
                            <div class="mockup-header__actions">
                                <div class="mockup-btn mockup-btn--primary"><i class="fa-solid fa-plus"></i> Buat Surat</div>
                            </div>
                        </div>
                        <div class="mockup-stats">
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">124</div>
                                <div class="mockup-stat__label">Surat Bulan Ini</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">5</div>
                                <div class="mockup-stat__label">Menunggu</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">98%</div>
                                <div class="mockup-stat__label">Selesai</div>
                            </div>
                        </div>
                        <table class="mockup-table">
                            <thead>
                                <tr>
                                    <th>No. Surat</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SK-2026-0128</td>
                                    <td>Surat Ket. Domisili</td>
                                    <td><span class="mockup-badge mockup-badge--success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>SK-2026-0127</td>
                                    <td>Surat Ket. Usaha</td>
                                    <td><span class="mockup-badge mockup-badge--success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>SK-2026-0126</td>
                                    <td>Pengantar KTP</td>
                                    <td><span class="mockup-badge mockup-badge--warning">Proses</span></td>
                                </tr>
                                <tr>
                                    <td>SK-2026-0125</td>
                                    <td>Surat Pindah</td>
                                    <td><span class="mockup-badge mockup-badge--info">Review</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================= -->
<!-- APP 2: APLIKASI JORONG -->
<!-- ============================================= -->
<section class="app-section app-section--gray" id="jorong">
    <div class="container">
        <div class="app-section__layout app-section__layout--reverse">
            <!-- Text Side -->
            <div class="app-section__info reveal-right">
                <div class="app-section__icon-badge">
                    <div class="app-section__icon-circle">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <span class="app-section__app-name">Aplikasi Dusun/Jorong</span>
                </div>

                <h2 class="app-section__title">Manajemen Dusun/Jorong Terintegrasi</h2>

                <p class="app-section__desc">
                    Kelola seluruh data dan administrasi di tingkat dusun/jorong secara efisien. Aplikasi ini dirancang agar Kepala Jorong bisa mencatat kegiatan, mengelola data penduduk, dan membuat laporan kematian secara periodik.
                </p>
                <p class="app-section__desc">
                    Semua data dari setiap jorong tersinkronisasi secara real-time ke sistem nagari pusat, memastikan konsistensi data dan memudahkan koordinasi antara jorong dan pemerintahan nagari.
                </p>

                <div class="app-section__features stagger">
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-chart-pie"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Dashboard Data Jorong</h4>
                            <p>Ringkasan data lengkap di satu tampilan</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Pencatatan Kegiatan</h4>
                            <p>Dokumentasi aktivitas jorong otomatis</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Laporan Periodik Otomatis</h4>
                            <p>Generate laporan bulanan</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-arrows-rotate"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Sinkronisasi Data Nagari</h4>
                            <p>Real-time sync dengan sistem nagari pusat</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-map"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Peta Wilayah Jorong</h4>
                            <p>Visualisasi data geospasial interaktif</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-list-ol"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Rekapitulasi Data Penduduk</h4>
                            <p>Rekap data per jorong otomatis</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-comments"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Komunikasi Antar Jorong</h4>
                            <p>Pesan dan koordinasi lintas jorong</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Mockup Side -->
            <div class="app-mockup reveal-left">
                <div class="app-mockup__float app-mockup__float--tr" style="color: #0E8A4A;">
                    <i class="fa-solid fa-sync"></i> Data Synced
                </div>
                <div class="app-mockup__float app-mockup__float--bl" style="color: #d97706;">
                    <i class="fa-solid fa-users"></i> 1.240 Penduduk
                </div>

                <div class="app-mockup__frame">
                    <div class="app-mockup__toolbar">
                        <div class="app-mockup__dot app-mockup__dot--red"></div>
                        <div class="app-mockup__dot app-mockup__dot--yellow"></div>
                        <div class="app-mockup__dot app-mockup__dot--green"></div>
                        <div class="app-mockup__url">
                            <i class="fa-solid fa-lock"></i> nagaridigital.web.id/jorong
                        </div>
                    </div>
                    <div class="app-mockup__body">
                        <div class="mockup-header">
                            <div class="mockup-header__title">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <span>Dashboard Jorong</span>
                            </div>
                            <div class="mockup-header__actions">
                                <div class="mockup-btn mockup-btn--outline"><i class="fa-solid fa-download"></i> Export</div>
                            </div>
                        </div>
                        <div class="mockup-stats">
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">4</div>
                                <div class="mockup-stat__label">Total Jorong</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">3.820</div>
                                <div class="mockup-stat__label">Penduduk</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">12</div>
                                <div class="mockup-stat__label">RT/RW</div>
                            </div>
                        </div>
                        <div class="mockup-list">
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--green"><i class="fa-solid fa-location-dot"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Jorong Pasar</span>
                                    <small>1.240 penduduk • 4 RT</small>
                                </div>
                                <span class="mockup-badge mockup-badge--success">Aktif</span>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--blue"><i class="fa-solid fa-location-dot"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Jorong Koto</span>
                                    <small>980 penduduk • 3 RT</small>
                                </div>
                                <span class="mockup-badge mockup-badge--success">Aktif</span>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--orange"><i class="fa-solid fa-location-dot"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Jorong Padang</span>
                                    <small>860 penduduk • 3 RT</small>
                                </div>
                                <span class="mockup-badge mockup-badge--success">Aktif</span>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--purple"><i class="fa-solid fa-location-dot"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Jorong Sawah</span>
                                    <small>740 penduduk • 2 RT</small>
                                </div>
                                <span class="mockup-badge mockup-badge--success">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================= -->
<!-- APP 3: PENDATAAN PENDUDUK -->
<!-- ============================================= -->
<section class="app-section" id="pendataan">
    <div class="container">
        <div class="app-section__layout">
            <!-- Text Side -->
            <div class="app-section__info reveal-left">
                <div class="app-section__icon-badge">
                    <div class="app-section__icon-circle">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <span class="app-section__app-name">Pendataan Penduduk</span>
                </div>

                <h2 class="app-section__title">Database Penduduk Cerdas & Akurat</h2>

                <p class="app-section__desc">
                    Sistem pencatatan dan pendataan penduduk yang komprehensif dengan validasi data otomatis. Catat seluruh informasi kependudukan mulai dari data dasar, pendidikan, pekerjaan, hingga klasifikasi sosial ekonomi — semuanya dalam format terstruktur yang mudah dikelola.
                </p>
                <p class="app-section__desc">
                    Dilengkapi dengan dashboard statistik demografi real-time, grafik interaktif, dan kemampuan export laporan dalam format PDF maupun Excel. Pencarian data super cepat memungkinkan petugas menemukan informasi penduduk dalam hitungan detik.
                </p>

                <div class="app-section__features stagger">
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-keyboard"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Input Data Terstruktur</h4>
                            <p>Form tervalidasi, data selalu akurat</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Statistik Demografi Real-time</h4>
                            <p>Dashboard live data kependudukan</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-file-export"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Export PDF & Excel</h4>
                            <p>Unduh laporan dalam berbagai format</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-chart-column"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Grafik Interaktif</h4>
                            <p>Visualisasi data yang mudah dipahami</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Pencarian Cepat</h4>
                            <p>Temukan data penduduk dalam hitungan detik</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-rotate-left"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Riwayat Perubahan</h4>
                            <p>Audit trail setiap perubahan data</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-layer-group"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Klasifikasi Penduduk</h4>
                            <p>Berdasarkan usia, pekerjaan, pendidikan</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-file-import"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Import dari Spreadsheet</h4>
                            <p>Migrasi data mudah dari Excel/CSV</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Mockup Side -->
            <div class="app-mockup reveal-right">
                <div class="app-mockup__float app-mockup__float--tl" style="color: #0E8A4A;">
                    <i class="fa-solid fa-chart-line"></i> +12% Bulan Ini
                </div>
                <div class="app-mockup__float app-mockup__float--br" style="color: #7c3aed;">
                    <i class="fa-solid fa-database"></i> 5.420 Data
                </div>

                <div class="app-mockup__frame">
                    <div class="app-mockup__toolbar">
                        <div class="app-mockup__dot app-mockup__dot--red"></div>
                        <div class="app-mockup__dot app-mockup__dot--yellow"></div>
                        <div class="app-mockup__dot app-mockup__dot--green"></div>
                        <div class="app-mockup__url">
                            <i class="fa-solid fa-lock"></i> nagaridigital.web.id/pendataan
                        </div>
                    </div>
                    <div class="app-mockup__body">
                        <div class="mockup-header">
                            <div class="mockup-header__title">
                                <i class="fa-solid fa-users-rectangle"></i>
                                <span>Pendataan Penduduk</span>
                            </div>
                            <div class="mockup-header__actions">
                                <div class="mockup-btn mockup-btn--primary"><i class="fa-solid fa-plus"></i> Tambah</div>
                                <div class="mockup-btn mockup-btn--outline"><i class="fa-solid fa-file-export"></i> Export</div>
                            </div>
                        </div>
                        <div class="mockup-stats">
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">5.420</div>
                                <div class="mockup-stat__label">Total Penduduk</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">1.385</div>
                                <div class="mockup-stat__label">Kepala Keluarga</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">52%</div>
                                <div class="mockup-stat__label">Laki-laki</div>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="mockup-chart">
                            <div class="mockup-chart__bar" style="height: 45%;"></div>
                            <div class="mockup-chart__bar" style="height: 70%;"></div>
                            <div class="mockup-chart__bar" style="height: 90%;"></div>
                            <div class="mockup-chart__bar" style="height: 60%;"></div>
                            <div class="mockup-chart__bar" style="height: 80%;"></div>
                            <div class="mockup-chart__bar" style="height: 55%;"></div>
                            <div class="mockup-chart__bar" style="height: 75%;"></div>
                            <div class="mockup-chart__bar" style="height: 40%;"></div>
                            <div class="mockup-chart__bar" style="height: 65%;"></div>
                            <div class="mockup-chart__bar" style="height: 50%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================= -->
<!-- APP 4: APLIKASI POSYANDU -->
<!-- ============================================= -->
<section class="app-section app-section--gray" id="posyandu">
    <div class="container">
        <div class="app-section__layout app-section__layout--reverse">
            <!-- Text Side -->
            <div class="app-section__info reveal-right">
                <div class="app-section__icon-badge">
                    <div class="app-section__icon-circle">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <span class="app-section__app-name">Aplikasi Posyandu</span>
                </div>

                <h2 class="app-section__title">Posyandu Digital untuk Kesehatan Masyarakat</h2>

                <p class="app-section__desc">
                    Digitalisasi pencatatan kesehatan balita dan lansia di posyandu nagari Anda. Kartu Menuju Sehat (KMS) digital menggantikan pencatatan manual, sehingga data pertumbuhan dan perkembangan anak bisa dipantau secara akurat dari waktu ke waktu.
                </p>
                <p class="app-section__desc">
                    Kader posyandu bisa dengan mudah mencatat berat badan, tinggi badan, imunisasi, dan data kesehatan lainnya. Sistem juga menyediakan jadwal imunisasi otomatis dan reminder untuk orang tua, memastikan tidak ada jadwal yang terlewat.
                </p>

                <div class="app-section__features stagger">
                    <!-- <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-id-card"></i></div>
                        <div class="app-section__feature-text">
                            <h4>KMS Digital</h4>
                            <p>Kartu Menuju Sehat dalam format digital</p>
                        </div>
                    </div> -->
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-syringe"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Jadwal Imunisasi Otomatis</h4>
                            <p>Penjadwalan dan tracking imunisasi</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-baby"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Monitoring Tumbuh Kembang</h4>
                            <p>Pantau perkembangan balita secara berkala</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-person-cane"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Pencatatan Kesehatan Lansia</h4>
                            <p>Data tekanan darah, gula darah, dll</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-chart-area"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Grafik Pertumbuhan Anak</h4>
                            <p>Kurva pertumbuhan sesuai standar WHO</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-bell"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Reminder Jadwal Posyandu</h4>
                            <p>Notifikasi otomatis untuk orang tua</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-apple-whole"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Laporan Gizi Bulanan</h4>
                            <p>Rekap status gizi balita per bulan</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-person-pregnant"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Data Ibu Hamil & Menyusui</h4>
                            <p>Pemantauan kesehatan ibu dan anak</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Mockup Side -->
            <div class="app-mockup reveal-left">
                <div class="app-mockup__float app-mockup__float--tl" style="color: #ef4444;">
                    <i class="fa-solid fa-heart"></i> Gizi Baik: 94%
                </div>
                <div class="app-mockup__float app-mockup__float--br" style="color: #22c55e;">
                    <i class="fa-solid fa-syringe"></i> Imunisasi Lengkap
                </div>

                <div class="app-mockup__frame">
                    <div class="app-mockup__toolbar">
                        <div class="app-mockup__dot app-mockup__dot--red"></div>
                        <div class="app-mockup__dot app-mockup__dot--yellow"></div>
                        <div class="app-mockup__dot app-mockup__dot--green"></div>
                        <div class="app-mockup__url">
                            <i class="fa-solid fa-lock"></i> nagaridigital.web.id/posyandu
                        </div>
                    </div>
                    <div class="app-mockup__body">
                        <div class="mockup-header">
                            <div class="mockup-header__title">
                                <i class="fa-solid fa-heart-pulse"></i>
                                <span>Aplikasi Posyandu</span>
                            </div>
                        </div>
                        <div class="mockup-stats">
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">86</div>
                                <div class="mockup-stat__label">Balita</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">42</div>
                                <div class="mockup-stat__label">Lansia</div>
                            </div>
                            <div class="mockup-stat">
                                <div class="mockup-stat__number">15</div>
                                <div class="mockup-stat__label">Ibu Hamil</div>
                            </div>
                        </div>
                        <div class="mockup-list">
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--green"><i class="fa-solid fa-baby"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Ahmad Rafa (2 thn)</span>
                                    <small>BB: 12.5 kg • TB: 86 cm • Gizi Baik</small>
                                </div>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--blue"><i class="fa-solid fa-baby"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Aisyah Putri (1.5 thn)</span>
                                    <small>BB: 10.2 kg • TB: 78 cm • Gizi Baik</small>
                                </div>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-item__icon mockup-list-item__icon--orange"><i class="fa-solid fa-person-cane"></i></div>
                                <div class="mockup-list-item__text">
                                    <span>Hj. Fatimah (68 thn)</span>
                                    <small>TD: 130/85 • GD: Normal</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================= -->
<!-- APP 5: WEBSITE NAGARI -->
<!-- ============================================= -->
<section class="app-section" id="website">
    <div class="container">
        <div class="app-section__layout">
            <!-- Text Side -->
            <div class="app-section__info reveal-left">
                <div class="app-section__icon-badge">
                    <div class="app-section__icon-circle">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <span class="app-section__app-name">Website Desa/Nagari</span>
                </div>

                <h2 class="app-section__title">Portal Informasi Resmi Nagari</h2>

                <p class="app-section__desc">
                    Miliki website resmi nagari yang modern, profesional, dan mudah dikelola tanpa perlu keahlian coding. Website ini menjadi wajah digital nagari Anda di internet — menampilkan profil pemerintahan, berita, agenda, layanan publik, galeri, dan informasi penting lainnya.
                </p>
                <p class="app-section__desc">
                    Dibangun dengan teknologi terkini dan dioptimasi untuk mesin pencari (SEO), website nagari Anda akan mudah ditemukan oleh masyarakat. CMS yang user-friendly memungkinkan perangkat nagari mengelola konten secara mandiri kapan saja.
                </p>

                <div class="app-section__features stagger">
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-palette"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Desain Modern & Responsif</h4>
                            <p>Tampil sempurna di semua perangkat</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                        <div class="app-section__feature-text">
                            <h4>CMS Tanpa Coding</h4>
                            <p>Kelola konten mudah tanpa keahlian teknis</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                        <div class="app-section__feature-text">
                            <h4>SEO Optimized</h4>
                            <p>Mudah ditemukan di Google dan Bing</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-newspaper"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Berita & Artikel</h4>
                            <p>Publikasi berita kegiatan nagari</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-landmark"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Profil Pemerintahan</h4>
                            <p>Tampilkan struktur pemerintahan nagari</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-images"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Galeri Foto & Video</h4>
                            <p>Dokumentasi kegiatan nagari yang menarik</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-hands-helping"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Halaman Layanan Publik</h4>
                            <p>Informasi layanan untuk masyarakat</p>
                        </div>
                    </div>
                    <div class="app-section__feature-item reveal">
                        <div class="app-section__feature-icon"><i class="fa-solid fa-chart-simple"></i></div>
                        <div class="app-section__feature-text">
                            <h4>Statistik Pengunjung</h4>
                            <p>Pantau traffic website secara real-time</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Mockup Side -->
            <div class="app-mockup reveal-right">
                <div class="app-mockup__float app-mockup__float--tl" style="color: #2563eb;">
                    <i class="fa-solid fa-eye"></i> 2.4K Pengunjung
                </div>
                <div class="app-mockup__float app-mockup__float--br" style="color: #22c55e;">
                    <i class="fa-solid fa-bolt"></i> PageSpeed 96
                </div>

                <div class="app-mockup__frame">
                    <div class="app-mockup__toolbar">
                        <div class="app-mockup__dot app-mockup__dot--red"></div>
                        <div class="app-mockup__dot app-mockup__dot--yellow"></div>
                        <div class="app-mockup__dot app-mockup__dot--green"></div>
                        <div class="app-mockup__url">
                            <i class="fa-solid fa-lock"></i> kuamangalai-ug.nagaridigital.web.id
                        </div>
                    </div>
                    <div class="app-mockup__body">
                        <div class="mockup-sidebar-layout">
                            <div class="mockup-sidebar">
                                <div class="mockup-sidebar__item mockup-sidebar__item--active"><i class="fa-solid fa-house"></i> Beranda</div>
                                <div class="mockup-sidebar__item"><i class="fa-solid fa-landmark"></i> Profil</div>
                                <div class="mockup-sidebar__item"><i class="fa-solid fa-newspaper"></i> Berita</div>
                                <div class="mockup-sidebar__item"><i class="fa-solid fa-images"></i> Galeri</div>
                                <div class="mockup-sidebar__item"><i class="fa-solid fa-concierge-bell"></i> Layanan</div>
                                <div class="mockup-sidebar__item"><i class="fa-solid fa-envelope"></i> Kontak</div>
                            </div>
                            <div class="mockup-main">
                                <div class="mockup-stats" style="margin-bottom: var(--space-3);">
                                    <div class="mockup-stat">
                                        <div class="mockup-stat__number">2.4K</div>
                                        <div class="mockup-stat__label">Pengunjung</div>
                                    </div>
                                    <div class="mockup-stat">
                                        <div class="mockup-stat__number">18</div>
                                        <div class="mockup-stat__label">Artikel</div>
                                    </div>
                                    <div class="mockup-stat">
                                        <div class="mockup-stat__number">96</div>
                                        <div class="mockup-stat__label">PageSpeed</div>
                                    </div>
                                </div>
                                <div class="mockup-list">
                                    <div class="mockup-list-item">
                                        <div class="mockup-list-item__icon mockup-list-item__icon--green"><i class="fa-solid fa-newspaper"></i></div>
                                        <div class="mockup-list-item__text">
                                            <span>Musyawarah Nagari 2026</span>
                                            <small>Dipublikasi 2 hari lalu</small>
                                        </div>
                                    </div>
                                    <div class="mockup-list-item">
                                        <div class="mockup-list-item__icon mockup-list-item__icon--blue"><i class="fa-solid fa-calendar-days"></i></div>
                                        <div class="mockup-list-item__text">
                                            <span>Jadwal Gotong Royong</span>
                                            <small>Dipublikasi 5 hari lalu</small>
                                        </div>
                                    </div>
                                    <div class="mockup-list-item">
                                        <div class="mockup-list-item__icon mockup-list-item__icon--orange"><i class="fa-solid fa-trophy"></i></div>
                                        <div class="mockup-list-item__text">
                                            <span>Nagari Terbaik Se-Kab.</span>
                                            <small>Dipublikasi 1 minggu lalu</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================= -->
<!-- INTEGRATION SECTION (DARK) -->
<!-- ============================================= -->
<section class="integration" id="integrasi">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Integrasi Penuh</span>
            <h2>Semua Aplikasi Saling Terhubung</h2>
            <p>Kelima aplikasi Nagari Digital bekerja sebagai satu ekosistem terintegrasi — data saling terhubung, konsisten, dan selalu ter-update secara real-time.</p>
        </div>

        <div class="integration__diagram reveal-scale">
            <!-- Center Hub -->
            <div class="integration__hub">
                <div class="integration__center">
                    <div class="integration__center-inner">
                        <i class="fa-solid fa-leaf"></i>
                        <span>Nagari<br>Digital</span>
                    </div>
                </div>

                <!-- Connecting lines visual -->
                <div class="integration__connectors">
                    <div class="integration__line"></div>
                    <div class="integration__line"></div>
                    <div class="integration__line"></div>
                    <div class="integration__line"></div>
                    <div class="integration__line"></div>
                </div>

                <!-- App Nodes -->
                <div class="integration__nodes stagger">
                    <div class="integration__node reveal">
                        <div class="integration__node-icon">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>
                        <h4>Pelayanan</h4>
                        <p>Data surat terhubung dengan database penduduk</p>
                    </div>
                    <div class="integration__node reveal">
                        <div class="integration__node-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <h4>Dusun/Jorong</h4>
                        <p>Data jorong sinkron ke nagari secara otomatis</p>
                    </div>
                    <div class="integration__node reveal">
                        <div class="integration__node-icon">
                            <i class="fa-solid fa-users-rectangle"></i>
                        </div>
                        <h4>Pendataan</h4>
                        <p>Database pusat yang digunakan seluruh aplikasi</p>
                    </div>
                    <div class="integration__node reveal">
                        <div class="integration__node-icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h4>Posyandu</h4>
                        <p>Data kesehatan terintegrasi dengan data penduduk</p>
                    </div>
                    <div class="integration__node reveal">
                        <div class="integration__node-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <h4>Website</h4>
                        <p>Informasi publik otomatis dari data internal</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Integration Flow -->
        <div class="integration__flow stagger">
            <div class="integration__flow-item reveal">
                <div class="integration__flow-number">1</div>
                <div class="integration__flow-content">
                    <h4>Satu Database Terpusat</h4>
                    <p>Semua data penduduk tersimpan di satu tempat. Perubahan di satu aplikasi langsung tersinkronisasi ke semua aplikasi lainnya.</p>
                </div>
            </div>
            <div class="integration__flow-item reveal">
                <div class="integration__flow-number">2</div>
                <div class="integration__flow-content">
                    <h4>Alur Kerja Otomatis</h4>
                    <p>Data dari pendataan otomatis tersedia di pelayanan, posyandu menggunakan data penduduk yang sama, dan website menampilkan statistik terkini.</p>
                </div>
            </div>
            <div class="integration__flow-item reveal">
                <div class="integration__flow-number">3</div>
                <div class="integration__flow-content">
                    <h4>Laporan Komprehensif</h4>
                    <p>Gabungkan data dari seluruh aplikasi untuk menghasilkan laporan nagari yang lengkap dan akurat dalam satu klik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================= -->
<!-- CTA SECTION -->
<!-- ============================================= -->
<section class="fitur-cta">
    <div class="container">
        <div class="fitur-cta__box reveal-scale">
            <h2>Mulai Gunakan Nagari Digital</h2>
            <p>Tingkatkan efisiensi pemerintahan nagari Anda dengan 5 aplikasi terintegrasi. Mulai dari Rp 450.000/bulan.</p>
            <div class="fitur-cta__buttons">
                <a href="{{ route('harga') }}" class="btn btn--white btn--lg">
                    <i class="fa-solid fa-tag"></i> Lihat Paket Harga
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20tertarik%20dengan%20fitur%20Nagari%20Digital%20dan%20ingin%20konsultasi." target="_blank" class="btn btn--outline-white btn--lg">
                    <i class="fa-brands fa-whatsapp"></i> Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</section>

@endsection