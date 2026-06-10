@extends('site.layouts.app_1')

@push('styles')
<link rel="stylesheet" href="{{ asset('site/css/fitur.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/harga.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/tentang.css') }}">
@endpush

@section('content')

@php
$storyParagraphs = $aboutSections->firstWhere('type', 'story_paragraphs');
$storyHighlight = $aboutSections->firstWhere('type', 'story_highlight');
$vision = $aboutSections->firstWhere('type', 'vision');
$missions = $aboutSections->firstWhere('type', 'missions');
$values = $aboutSections->firstWhere('type', 'values');
$timeline = $aboutSections->firstWhere('type', 'timeline');
@endphp

<header class="page-hero">
    <div class="page-hero__orbs">
        <div class="page-hero__orb page-hero__orb--1"></div>
        <div class="page-hero__orb page-hero__orb--2"></div>
        <div class="page-hero__orb page-hero__orb--3"></div>
    </div>
    <div class="page-hero__grid"></div>

    <div class="container">
        <div class="page-hero__content">
            <div class="page-hero__badge">
                <i class="fa-solid fa-circle"></i>
                Mitra Digital Terpercaya
            </div>
            <h1 class="page-hero__title">
                Tentang <span class="highlight">Nagari Digital</span>
            </h1>
            <p class="page-hero__subtitle">
                Mitra Digital Terpercaya untuk Pemerintahan Nagari. Membangun masa depan desa yang lebih modern, transparan, dan efisien melalui teknologi.
            </p>
            <div class="page-hero__breadcrumb">
                <a href="index.html"><i class="fa-solid fa-house"></i> Beranda</a>
                <span class="separator"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="current">Tentang Kami</span>
            </div>
        </div>
    </div>
</header>

<section class="story">
    <div class="container">
        <div class="story__grid">
            <div class="story__visual reveal-left">
                <div class="story__image-frame">
                    <div class="story__icon-display">
                        <div class="story__icon-main">
                            <i class="fa-solid {{ $settings['logo_icon'] ?? 'fa-leaf' }}"></i>
                        </div>
                        <p class="story__icon-tagline">Digitalisasi untuk Nagari</p>
                    </div>
                    <div class="story__floating-badge story__floating-badge--top">
                        <i class="fa-solid fa-shield-halved"></i> Aman & Terpercaya
                    </div>
                    <div class="story__floating-badge story__floating-badge--bottom">
                        <i class="fa-solid fa-bolt"></i> Mudah & Cepat
                    </div>
                </div>
            </div>

            <div class="story__content reveal-right">
                <span class="section-tag">Cerita Kami</span>
                <h2>Dari Ide Sederhana, Lahir Solusi untuk Nagari</h2>
                @if($storyParagraphs)
                    @foreach($storyParagraphs->content as $paragraph)
                    <p>{{ $paragraph }}</p>
                    @endforeach
                @else
                    <p>Nagari Digital lahir dari keprihatinan terhadap kondisi administrasi pemerintahan nagari di Indonesia — khususnya di Sumatera Barat — yang masih sangat bergantung pada proses manual.</p>
                @endif
                @if($storyHighlight)
                <div class="story__highlight-box">
                    <p><i class="fa-solid fa-quote-left"></i> {{ $storyHighlight->content }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>


<section class="visi-misi section--dark">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Visi & Misi</span>
            <h2>Arah dan Tujuan Kami</h2>
            <p>Kami memiliki visi yang jelas dan misi yang terukur untuk memajukan pemerintahan nagari di seluruh Indonesia.</p>
        </div>

        <div class="visi-misi__grid stagger">
            <div class="visi-misi__card reveal">
                <div class="visi-misi__card-header">
                    <div class="visi-misi__card-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div>
                        <span class="visi-misi__card-subtitle">Visi</span>
                        <h3>Visi Kami</h3>
                    </div>
                </div>
                <p>{{ $vision ? $vision->content : 'Menjadi platform digitalisasi pemerintahan nagari/desa terdepan di Indonesia.' }}</p>
            </div>

            <div class="visi-misi__card reveal">
                <div class="visi-misi__card-header">
                    <div class="visi-misi__card-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <div>
                        <span class="visi-misi__card-subtitle">Misi</span>
                        <h3>Misi Kami</h3>
                    </div>
                </div>
                <ul class="visi-misi__list">
                    @if($missions)
                        @foreach($missions->content as $mission)
                        <li>
                            <div class="visi-misi__list-icon">
                                <i class="fa-solid {{ $mission['icon'] ?? 'fa-check' }}"></i>
                            </div>
                            <p>{{ $mission['text'] }}</p>
                        </li>
                        @endforeach
                    @else
                    <li><p>Menyediakan teknologi yang mudah digunakan untuk pemerintahan nagari.</p></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="values section--gray">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Nilai Kami</span>
            <h2>Nilai-Nilai yang Kami Pegang Teguh</h2>
            <p>Setiap keputusan dan langkah kami didasari oleh nilai-nilai yang menjadi fondasi dalam membangun Nagari Digital.</p>
        </div>

        <div class="values__grid stagger">
            @if($values)
                @foreach($values->content as $value)
                <div class="value-card reveal">
                    <div class="value-card__icon">
                        <i class="fa-solid {{ $value['icon'] }}"></i>
                    </div>
                    <h3>{{ $value['title'] }}</h3>
                    <p>{{ $value['desc'] }}</p>
                </div>
                @endforeach
            @else
            <div class="value-card reveal"><h3>Inovasi</h3><p>Terus mengembangkan fitur terbaru.</p></div>
            @endif
        </div>
    </div>
</section>


<section class="timeline">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Perjalanan Kami</span>
            <h2>Milestone & Roadmap</h2>
            <p>Dari ide sederhana menuju platform digital yang berdampak bagi nagari di seluruh Indonesia.</p>
        </div>

        @if($timeline)
        <div class="timeline__track">
            <div class="timeline__line">
                <div class="timeline__line-fill"></div>
            </div>

            @foreach($timeline->content as $index => $item)
            <div class="timeline__item reveal">
                @if($index % 2 == 0)
                <div class="timeline__card">
                    <div class="timeline__year">{{ $item['year'] }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['desc'] }}</p>
                    @if($item['status'] === 'done')
                    <span class="timeline__badge timeline__badge--done"><i class="fa-solid fa-check"></i> Selesai</span>
                    @elseif($item['status'] === 'current')
                    <span class="timeline__badge timeline__badge--current"><i class="fa-solid fa-spinner fa-spin"></i> Sedang Berjalan</span>
                    @else
                    <span class="timeline__badge timeline__badge--future"><i class="fa-solid fa-clock"></i> Rencana Masa Depan</span>
                    @endif
                </div>
                <div class="timeline__dot-wrapper">
                    <div class="timeline__dot">
                        <i class="fa-solid {{ $index == 0 ? 'fa-lightbulb' : ($index == 1 ? 'fa-rocket' : ($index == 2 ? 'fa-star' : 'fa-flag')) }}"></i>
                    </div>
                </div>
                <div class="timeline__card" style="visibility: hidden;"></div>
                @else
                <div class="timeline__card" style="visibility: hidden;"></div>
                <div class="timeline__dot-wrapper">
                    <div class="timeline__dot @if($item['status'] === 'future') timeline__dot--future @endif">
                        <i class="fa-solid {{ $index == 0 ? 'fa-lightbulb' : ($index == 1 ? 'fa-rocket' : ($index == 2 ? 'fa-star' : 'fa-flag')) }}"></i>
                    </div>
                </div>
                <div class="timeline__card">
                    <div class="timeline__year">{{ $item['year'] }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['desc'] }}</p>
                    @if($item['status'] === 'done')
                    <span class="timeline__badge timeline__badge--done"><i class="fa-solid fa-check"></i> Selesai</span>
                    @elseif($item['status'] === 'current')
                    <span class="timeline__badge timeline__badge--current"><i class="fa-solid fa-spinner fa-spin"></i> Sedang Berjalan</span>
                    @else
                    <span class="timeline__badge timeline__badge--future"><i class="fa-solid fa-clock"></i> Rencana Masa Depan</span>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>


<section class="about-stats section--dark">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Dalam Angka</span>
            <h2>Nagari Digital dalam Angka</h2>
            <p>Pencapaian yang kami raih bersama nagari-nagari mitra kami di seluruh Indonesia.</p>
        </div>

        <div class="about-stats__grid stagger">
            @foreach($stats as $stat)
            <div class="about-stats__card reveal">
                <div class="about-stats__icon">
                    <i class="fa-solid {{ $stat->icon }}"></i>
                </div>
                <div class="about-stats__number" data-count="{{ $stat->count }}" data-suffix="{{ $stat->suffix }}">0</div>
                <div class="about-stats__label">{{ $stat->label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="about-cta">
    <div class="container">
        <div class="about-cta__box reveal-scale">
            <h2>Bergabung Bersama Nagari Digital</h2>
            <p>Jadilah bagian dari nagari-nagari yang telah bertransformasi digital. Konsultasikan kebutuhan nagari Anda bersama tim kami — gratis dan tanpa komitmen.</p>
            <div class="about-cta__buttons">
                <a href="{{ route('harga') }}" class="btn btn--white btn--lg">
                    <i class="fa-solid fa-tag"></i> Lihat Paket Harga
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20tertarik%20dengan%20Nagari%20Digital%20dan%20ingin%20konsultasi." target="_blank" class="btn btn--outline-white btn--lg">
                    <i class="fa-brands fa-whatsapp"></i> Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
