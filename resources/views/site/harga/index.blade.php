@extends('site.layouts.app_1')

@push('styles')
<link rel="stylesheet" href="{{ asset('site/css/fitur.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/harga.css') }}">
@endpush

@section('content')
<header class="pricing-hero">
    <div class="pricing-hero__bg-orbs">
        <div class="pricing-hero__orb pricing-hero__orb--1"></div>
        <div class="pricing-hero__orb pricing-hero__orb--2"></div>
        <div class="pricing-hero__orb pricing-hero__orb--3"></div>
    </div>
    <div class="pricing-hero__grid-pattern"></div>

    <div class="pricing-hero__content">
        <div class="pricing-hero__badge">
            <i class="fa-solid fa-tags"></i>
            Harga Transparan &amp; Fleksibel
        </div>
        <h1 class="pricing-hero__title">
            Harga Transparan, <span class="text-gradient">Tanpa Biaya Tersembunyi</span>
        </h1>
        <p class="pricing-hero__subtitle">
            Pilih paket yang paling sesuai dengan kebutuhan dan anggaran nagari Anda. Fleksibel, terjangkau, dan bisa disesuaikan kapan saja.
        </p>
        <div class="pricing-hero__trust">
            <div class="pricing-hero__trust-item">
                <i class="fa-solid fa-shield-check"></i>
                <span>Tanpa biaya setup</span>
            </div>
            <div class="pricing-hero__trust-item">
                <i class="fa-solid fa-rotate"></i>
                <span>Bisa upgrade kapan saja</span>
            </div>
            <div class="pricing-hero__trust-item">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <span>Garansi 30 hari</span>
            </div>
        </div>
    </div>
</header>

<section class="pricing section--dark" id="pricing">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Paket Harga</span>
            <h2>Pilih Paket Terbaik untuk Nagari Anda</h2>
            <p>Semua paket sudah termasuk pelatihan penggunaan, setup awal, dan dukungan teknis. Tidak ada biaya tersembunyi.</p>
        </div>

        <div class="pricing-toggle reveal" id="pricingToggle">
            <span class="pricing-toggle__label">Pilih Periode:</span>
            <div class="pricing-toggle__buttons">
                <button class="pricing-toggle__btn active" data-period="bulanan">Bulanan</button>
                <button class="pricing-toggle__btn" data-period="6bulan">6 Bulan</button>
                <button class="pricing-toggle__btn" data-period="tahunan">Tahunan</button>
            </div>
        </div>

        <div class="pricing__grid stagger">
            @foreach($pricingPlans as $plan)
            <div class="pricing-card @if($plan->popular) pricing-card--popular @endif reveal" id="paket{{ ucfirst($plan->key) }}">
                @if($plan->popular)
                <div class="pricing-card__popular-badge">
                    <i class="fa-solid fa-star"></i> Paling Populer
                </div>
                @endif

                <div class="pricing-card__header">
                    <div class="pricing-card__icon @if($plan->popular) pricing-card__icon--popular @endif">
                        <i class="fa-solid {{ $plan->icon }}"></i>
                    </div>
                    <h3 class="pricing-card__name">{{ $plan->name }}</h3>
                    <p class="pricing-card__tagline">{{ $plan->tagline }}</p>
                </div>

                <div class="pricing-card__price-wrapper">
                    <div class="pricing-card__price">
                        <span class="pricing-card__currency">Rp</span>
                        <span class="pricing-card__amount"
                            data-monthly="{{ $plan->price['bulanan'] }}">{{ number_format($plan->price['bulanan'], 0, ',', '.') }}</span>
                        <span class="pricing-card__period">/bulan</span>
                    </div>
                    <div class="pricing-card__savings"></div>
                </div>

                <div class="pricing-card__apps">
                    <span class="pricing-card__apps-label">
                        @if($plan->key === 'lepas') Semua 5 aplikasi + source code:
                        @elseif($plan->popular) Semua 5 aplikasi termasuk:
                        @else Aplikasi yang termasuk:
                        @endif
                    </span>
                    <div class="pricing-card__app-badges">
                        @foreach($plan->apps as $app)
                        <span class="app-badge app-badge--included">
                            <i class="fa-solid {{ $loop->index == 0 ? 'fa-file-contract' : ($loop->index == 1 ? 'fa-map-location-dot' : ($loop->index == 2 ? 'fa-users-rectangle' : ($loop->index == 3 ? 'fa-heart-pulse' : 'fa-globe'))) }}"></i> {{ $app }}
                        </span>
                        @endforeach
                    </div>
                </div>

                <ul class="pricing-card__features">
                    @foreach($plan->features as $feature)
                    <li class="pricing-card__feature pricing-card__feature--{{ $feature->included ? 'included' : 'excluded' }}">
                        @if($feature->included)
                        <i class="fa-solid fa-circle-check"></i>
                        @else
                        <i class="fa-solid fa-circle-xmark"></i>
                        @endif
                        <span>{{ $feature->text }}</span>
                    </li>
                    @endforeach
                </ul>

                @auth
                    @if(Auth::user()->isClient())
                    <a href="{{ route('client.orders.create', $plan) }}" class="btn btn--primary btn--lg pricing-card__btn">
                        <i class="fa-solid fa-credit-card"></i> Pesan {{ $plan->name }} Sekarang
                    </a>
                    @elseif(Auth::user()->isAdmin())
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($plan->name) }}%20Nagari%20Digital." target="_blank" class="btn btn--outline-white pricing-card__btn">
                        <i class="fa-brands fa-whatsapp"></i> Hubungi via WhatsApp
                    </a>
                    @endif
                @endauth
                @guest
                <a href="{{ route('register') }}" class="btn @if($plan->popular) btn--primary btn--lg @else btn--outline-white @endif pricing-card__btn">
                    <i class="fa-solid fa-user-plus"></i> Daftar & Pesan {{ $plan->name }}
                </a>
                @endguest
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="comparison section--gray" id="comparison">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Perbandingan Fitur</span>
            <h2>Bandingkan Semua Paket</h2>
            <p>Lihat detail lengkap fitur yang tersedia di setiap paket untuk membantu Anda memilih.</p>
        </div>

        <div class="comparison__table-wrapper reveal-scale">
            <table class="comparison__table">
                <thead>
                    <tr>
                        <th class="comparison__feature-col">Fitur</th>
                        @foreach($pricingPlans as $plan)
                        <th class="comparison__plan-col @if($plan->popular) comparison__plan-col--popular @endif">
                            <div class="comparison__plan-name">
                                <i class="fa-solid {{ $plan->icon }}"></i>
                                {{ $plan->name }}
                                @if($plan->popular) <span class="comparison__popular-tag">Populer</span> @endif
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="comparison__section-row">
                        <td colspan="{{ $pricingPlans->count() + 1 }}"><i class="fa-solid fa-tag"></i> Harga</td>
                    </tr>
                    <tr>
                        <td>Harga (1 bulan)</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            Rp {{ number_format($plan->price['bulanan'], 0, ',', '.') }}
                            <small>/bulan</small>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Harga (6 bulan)</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            Rp {{ number_format($plan->price['bulanan'] * 6, 0, ',', '.') }}
                            <small>/6 bulan</small>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Harga (1 tahun)</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            Rp {{ number_format($plan->price['bulanan'] * 12, 0, ',', '.') }}
                            <small>/tahun</small>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Model pembayaran</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            {{ $plan->key === 'lepas' ? 'Beli putus' : 'Berlangganan' }}
                        </td>
                        @endforeach
                    </tr>

                    <tr class="comparison__section-row">
                        <td colspan="{{ $pricingPlans->count() + 1 }}"><i class="fa-solid fa-grid-2"></i> Aplikasi</td>
                    </tr>
                    <tr>
                        <td>Pelayanan Kependudukan</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            @if(in_array('Pelayanan Kependudukan', $plan->apps))
                            <i class="fa-solid fa-circle-check comparison__check"></i>
                            @else
                            <i class="fa-solid fa-circle-xmark comparison__cross"></i>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Aplikasi Jorong</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            @if(in_array('Aplikasi Jorong', $plan->apps))
                            <i class="fa-solid fa-circle-check comparison__check"></i>
                            @else
                            <i class="fa-solid fa-circle-xmark comparison__cross"></i>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Pendataan Penduduk</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            @if(in_array('Pendataan Penduduk', $plan->apps))
                            <i class="fa-solid fa-circle-check comparison__check"></i>
                            @else
                            <i class="fa-solid fa-circle-xmark comparison__cross"></i>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Aplikasi Posyandu</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            @if(in_array('Aplikasi Posyandu', $plan->apps))
                            <i class="fa-solid fa-circle-check comparison__check"></i>
                            @else
                            <i class="fa-solid fa-circle-xmark comparison__cross"></i>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Website Nagari</td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            @if(in_array('Website Nagari', $plan->apps))
                            <i class="fa-solid fa-circle-check comparison__check"></i>
                            @else
                            <i class="fa-solid fa-circle-xmark comparison__cross"></i>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        @foreach($pricingPlans as $plan)
                        <td @if($plan->popular) class="comparison__highlight" @endif>
                            @auth
                                @if(Auth::user()->isClient())
                                <a href="{{ route('client.orders.create', $plan) }}" class="btn btn--primary btn--sm">
                                    <i class="fa-solid fa-credit-card"></i> Pesan Online
                                </a>
                                @else
                                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($plan->name) }}%20Nagari%20Digital." target="_blank" class="btn btn--outline btn--sm">
                                    <i class="fa-brands fa-whatsapp"></i> Hubungi WA
                                </a>
                                @endif
                            @endauth
                            @guest
                            <a href="{{ route('register') }}" class="btn @if($plan->popular) btn--primary @else btn--outline @endif btn--sm">
                                <i class="fa-solid fa-user-plus"></i> Daftar & Pesan
                            </a>
                            @endguest
                        </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

<section class="faq" id="faq">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">FAQ</span>
            <h2>Pertanyaan yang Sering Diajukan</h2>
            <p>Temukan jawaban untuk pertanyaan umum seputar layanan dan paket harga Nagari Digital.</p>
        </div>

        <div class="faq__grid">
            @php $faqChunks = $faqs->split(2); @endphp
            @foreach($faqChunks as $chunk)
            <div class="faq__list reveal">
                @foreach($chunk as $faq)
                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false">
                        <span class="faq__question-icon"><i class="fa-solid {{ $faq->icon }}"></i></span>
                        <span class="faq__question-text">{{ $faq->question }}</span>
                        <span class="faq__toggle"><i class="fa-solid fa-plus"></i></span>
                    </button>
                    <div class="faq__answer">
                        <div class="faq__answer-content">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-pricing section--dark">
    <div class="container">
        <div class="cta-pricing__box reveal-scale">
            <div class="cta-pricing__glow"></div>
            <div class="cta-pricing__content">
                <span class="section-tag">Siap Memulai?</span>
                <h2>Masih Ragu? Konsultasikan dengan Tim Kami</h2>
                <p>Tim kami siap membantu Anda memilih paket yang paling sesuai dengan kebutuhan dan anggaran nagari Anda. Konsultasi gratis, tanpa komitmen!</p>
                <div class="cta-pricing__buttons">
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20ingin%20konsultasi%20mengenai%20paket%20Nagari%20Digital%20yang%20cocok%20untuk%20nagari%20kami." target="_blank" class="btn btn--whatsapp btn--lg">
                        <i class="fa-brands fa-whatsapp"></i> Konsultasi via WhatsApp
                    </a>
                    <a href="{{ route('kontak') }}" class="btn btn--outline-white btn--lg">
                        <i class="fa-solid fa-envelope"></i> Hubungi Kami
                    </a>
                </div>
                <div class="cta-pricing__guarantees">
                    <div class="cta-pricing__guarantee">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>Garansi 30 hari uang kembali</span>
                    </div>
                    <div class="cta-pricing__guarantee">
                        <i class="fa-solid fa-headset"></i>
                        <span>Support responsif via WhatsApp</span>
                    </div>
                    <div class="cta-pricing__guarantee">
                        <i class="fa-solid fa-gear"></i>
                        <span>Setup & training gratis</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
