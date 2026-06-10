@extends('site.layouts.app_1')


@section('content')
 <section class="kontak-info">
        <div class="container">
            <div class="kontak-info__grid stagger">
                <!-- WhatsApp Card -->
                <div class="kontak-info__card reveal">
                    <div class="kontak-info__icon kontak-info__icon--wa">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="kontak-info__title">WhatsApp</h3>
                    <p class="kontak-info__detail">{{ $settings['whatsapp'] ?? '0822-8418-6104' }}</p>
                    <p class="kontak-info__desc">Respon cepat dalam hitungan menit. Tersedia 24/7 untuk konsultasi dan support.</p>
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20tertarik%20dengan%20Nagari%20Digital" target="_blank" class="btn btn--whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> Chat Sekarang
                    </a>
                </div>

                <!-- Email Card -->
                <div class="kontak-info__card reveal">
                    <div class="kontak-info__icon kontak-info__icon--email">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h3 class="kontak-info__title">Email</h3>
                    <p class="kontak-info__detail">{{ $settings['email'] ?? 'info@nagaridigital.web.id' }}</p>
                    </div>
                    <p class="kontak-info__desc">Kirim pertanyaan atau proposal kerjasama. Kami akan merespons dalam 1x24 jam.</p>
                    <a href="mailto:{{ $settings['email'] ?? 'info@nagaridigital.web.id' }}" class="btn btn--primary">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Email
                    </a>
                </div>

                <!-- Location Card -->
                <div class="kontak-info__card reveal">
                    <div class="kontak-info__icon kontak-info__icon--loc">
                        <i class="fa-solid fa-map-marker-alt"></i>
                    </div>
                    <h3 class="kontak-info__title">Lokasi</h3>
                    <p class="kontak-info__detail">{{ $settings['location'] ?? 'Sumatera Barat, Indonesia' }}</p>
                    <p class="kontak-info__desc">Melayani seluruh nagari dan desa di Indonesia. Konsultasi bisa dilakukan secara online.</p>
                    <a href="https://maps.google.com/?q=Sumatera+Barat+Indonesia" target="_blank" class="btn btn--outline">
                        <i class="fa-solid fa-location-dot"></i> Lihat di Peta
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="kontak-form-section section--gray" id="form">
        <div class="container">
            <div class="kontak-form__wrapper">
                <!-- Left side info -->
                <div class="kontak-form__info reveal-left">
                    <span class="section-tag">Formulir Kontak</span>
                    <h2>Mulai Konsultasi <span class="text-gradient">Gratis</span></h2>
                    <p>Isi formulir di samping dan kami akan menghubungi Anda melalui WhatsApp. Tidak ada biaya konsultasi, tidak ada komitmen.</p>
                    
                    <div class="kontak-form__benefits">
                        <div class="kontak-form__benefit">
                            <div class="kontak-form__benefit-icon">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <h4>Respon Cepat</h4>
                                <p>Tim kami akan merespon dalam waktu kurang dari 30 menit pada jam kerja.</p>
                            </div>
                        </div>
                        <div class="kontak-form__benefit">
                            <div class="kontak-form__benefit-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <h4>Konsultasi Gratis</h4>
                                <p>Diskusikan kebutuhan nagari Anda tanpa biaya dan tanpa komitmen.</p>
                            </div>
                        </div>
                        <div class="kontak-form__benefit">
                            <div class="kontak-form__benefit-icon">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <div>
                                <h4>Demo Langsung</h4>
                                <p>Kami bisa jadwalkan demo produk sesuai waktu Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right side form -->
                <div class="kontak-form__card reveal-right">
                    <form id="kontakForm" class="kontak-form" novalidate>
                        <div class="kontak-form__row">
                            <div class="kontak-form__group">
                                <div class="kontak-form__input-wrap">
                                    <input type="text" id="nama" name="nama" required placeholder=" " autocomplete="name">
                                    <label for="nama">
                                        <i class="fa-solid fa-user"></i> Nama Lengkap <span class="required">*</span>
                                    </label>
                                    <div class="kontak-form__focus-line"></div>
                                </div>
                                <span class="kontak-form__error" id="namaError"></span>
                            </div>
                            <div class="kontak-form__group">
                                <div class="kontak-form__input-wrap">
                                    <input type="email" id="email" name="email" placeholder=" " autocomplete="email">
                                    <label for="email">
                                        <i class="fa-solid fa-envelope"></i> Email
                                    </label>
                                    <div class="kontak-form__focus-line"></div>
                                </div>
                                <span class="kontak-form__error" id="emailError"></span>
                            </div>
                        </div>

                        <div class="kontak-form__row">
                            <div class="kontak-form__group">
                                <div class="kontak-form__input-wrap">
                                    <input type="tel" id="whatsapp" name="whatsapp" required placeholder=" " autocomplete="tel">
                                    <label for="whatsapp">
                                        <i class="fa-brands fa-whatsapp"></i> Nomor WhatsApp <span class="required">*</span>
                                    </label>
                                    <div class="kontak-form__focus-line"></div>
                                </div>
                                <span class="kontak-form__error" id="whatsappError"></span>
                            </div>
                            <div class="kontak-form__group">
                                <div class="kontak-form__input-wrap">
                                    <input type="text" id="nagari" name="nagari" required placeholder=" " autocomplete="organization">
                                    <label for="nagari">
                                        <i class="fa-solid fa-building-columns"></i> Nama Nagari/Desa <span class="required">*</span>
                                    </label>
                                    <div class="kontak-form__focus-line"></div>
                                </div>
                                <span class="kontak-form__error" id="nagariError"></span>
                            </div>
                        </div>

                        <div class="kontak-form__group">
                            <div class="kontak-form__input-wrap kontak-form__input-wrap--select">
                                <select id="paket" name="paket">
                                    <option value="" disabled selected></option>
                                    <option value="Paket Dasar">Paket Dasar — Rp 450.000/bulan</option>
                                    <option value="Paket Komplet">Paket Komplet — Rp 9.500.000/tahun</option>
                                    <option value="Paket Lepas">Paket Lepas — Rp 15.000.000 (beli putus)</option>
                                    <option value="Belum Yakin">Belum Yakin / Ingin Konsultasi</option>
                                </select>
                                <label for="paket">
                                    <i class="fa-solid fa-tag"></i> Pilih Paket
                                </label>
                                <div class="kontak-form__focus-line"></div>
                            </div>
                        </div>

                        <div class="kontak-form__group">
                            <div class="kontak-form__input-wrap">
                                <textarea id="pesan" name="pesan" rows="4" placeholder=" "></textarea>
                                <label for="pesan">
                                    <i class="fa-solid fa-message"></i> Pesan (opsional)
                                </label>
                                <div class="kontak-form__focus-line"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn--primary btn--lg kontak-form__submit" id="submitBtn">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>Kirim via WhatsApp</span>
                            <div class="kontak-form__submit-loader" id="submitLoader">
                                <i class="fa-solid fa-spinner fa-spin"></i>
                            </div>
                        </button>
                        <p class="kontak-form__disclaimer">
                            <i class="fa-solid fa-lock"></i> Data Anda aman dan tidak akan dibagikan ke pihak ketiga.
                        </p>
                    </form>

                    <!-- Success message -->
                    <div class="kontak-form__success" id="formSuccess">
                        <div class="kontak-form__success-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <h3>Pesan Terkirim!</h3>
                        <p>Terima kasih telah menghubungi kami. Anda akan diarahkan ke WhatsApp untuk melanjutkan percakapan.</p>
                        <button class="btn btn--outline" id="resetFormBtn">
                            <i class="fa-solid fa-rotate-right"></i> Kirim Pesan Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="kontak-faq" id="faq">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">FAQ</span>
                <h2>Pertanyaan yang Sering Diajukan</h2>
                <p>Temukan jawaban untuk pertanyaan umum seputar layanan Nagari Digital.</p>
            </div>

            <div class="kontak-faq__list">
                @foreach($faqs as $faq)
                <div class="kontak-faq__item reveal">
                    <button class="kontak-faq__question" aria-expanded="false">
                        <div class="kontak-faq__q-left">
                            <span class="kontak-faq__q-icon"><i class="fa-solid {{ $faq->icon }}"></i></span>
                            <span>{{ $faq->question }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-down kontak-faq__chevron"></i>
                    </button>
                    <div class="kontak-faq__answer">
                        {!! $faq->answer !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Map / Lokasi Section -->
    <section class="kontak-map section--dark">
        <div class="container">
            <div class="kontak-map__wrapper">
                <div class="kontak-map__info reveal-left">
                    <span class="section-tag">Lokasi Kami</span>
                    <h2>Berbasis di <span class="text-gradient">Sumatera Barat</span></h2>
                    <p>Melayani digitalisasi pemerintahan nagari dan desa di seluruh Indonesia.</p>
                    
                    <div class="kontak-map__details">
                        <div class="kontak-map__detail">
                            <div class="kontak-map__detail-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h4>Alamat</h4>
                                <p>Sumatera Barat, Indonesia</p>
                            </div>
                        </div>
                        <div class="kontak-map__detail">
                            <div class="kontak-map__detail-icon">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <h4>WhatsApp</h4>
                                <p><a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}" target="_blank">{{ $settings['whatsapp'] ?? '0822-8418-6104' }}</a></p>
                            </div>
                        </div>
                        <div class="kontak-map__detail">
                            <div class="kontak-map__detail-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p><a href="mailto:{{ $settings['email'] ?? 'info@nagaridigital.web.id' }}">{{ $settings['email'] ?? 'info@nagaridigital.web.id' }}</a></p>
                            </div>
                        </div>
                        <div class="kontak-map__detail">
                            <div class="kontak-map__detail-icon">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <h4>Jam Operasional</h4>
                                <p>Senin — Sabtu, 08:00 — 21:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kontak-map__visual reveal-right">
                    <div class="kontak-map__card">
                        <div class="kontak-map__illustration">
                            <div class="kontak-map__pin">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <svg viewBox="0 0 400 300" class="kontak-map__svg" xmlns="http://www.w3.org/2000/svg">
                                <!-- Decorative Map of Sumatera Barat -->
                                <defs>
                                    <linearGradient id="mapGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:rgba(14,138,74,0.3)"/>
                                        <stop offset="100%" style="stop-color:rgba(34,197,94,0.1)"/>
                                    </linearGradient>
                                    <filter id="glow">
                                        <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                        <feMerge>
                                            <feMergeNode in="coloredBlur"/>
                                            <feMergeNode in="SourceGraphic"/>
                                        </feMerge>
                                    </filter>
                                </defs>
                                <!-- Island shape (stylized Sumatera) -->
                                <path d="M120,30 Q140,20 160,35 Q185,55 195,80 Q210,110 220,140 Q230,165 235,190 Q238,215 230,240 Q220,265 200,275 Q175,280 155,270 Q135,255 125,230 Q118,210 115,185 Q110,160 105,135 Q100,110 105,85 Q108,55 120,30 Z" 
                                      fill="url(#mapGrad)" stroke="rgba(34,197,94,0.4)" stroke-width="1.5"/>
                                <!-- Grid lines -->
                                <line x1="50" y1="50" x2="350" y2="50" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="50" y1="100" x2="350" y2="100" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="50" y1="150" x2="350" y2="150" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="50" y1="200" x2="350" y2="200" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="50" y1="250" x2="350" y2="250" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="100" y1="10" x2="100" y2="290" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="150" y1="10" x2="150" y2="290" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="200" y1="10" x2="200" y2="290" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="250" y1="10" x2="250" y2="290" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <line x1="300" y1="10" x2="300" y2="290" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/>
                                <!-- Location dot with pulse -->
                                <circle cx="170" cy="140" r="6" fill="#22C55E" filter="url(#glow)">
                                    <animate attributeName="r" values="5;8;5" dur="2s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="1;0.6;1" dur="2s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="170" cy="140" r="16" fill="none" stroke="rgba(34,197,94,0.3)" stroke-width="1">
                                    <animate attributeName="r" values="12;24;12" dur="2s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.6;0;0.6" dur="2s" repeatCount="indefinite"/>
                                </circle>
                                <!-- Label -->
                                <text x="185" y="138" fill="rgba(255,255,255,0.7)" font-size="11" font-family="Inter, sans-serif">Sumatera</text>
                                <text x="185" y="155" fill="rgba(255,255,255,0.7)" font-size="11" font-family="Inter, sans-serif">Barat</text>
                                <!-- Additional city dots -->
                                <circle cx="155" cy="95" r="2.5" fill="rgba(34,197,94,0.5)"/>
                                <circle cx="180" cy="180" r="2.5" fill="rgba(34,197,94,0.5)"/>
                                <circle cx="140" cy="200" r="2.5" fill="rgba(34,197,94,0.5)"/>
                                <circle cx="160" cy="240" r="2" fill="rgba(34,197,94,0.4)"/>
                                <circle cx="195" cy="110" r="2" fill="rgba(34,197,94,0.4)"/>
                                <!-- Indonesia label -->
                                <text x="260" y="280" fill="rgba(255,255,255,0.2)" font-size="14" font-family="Poppins, sans-serif" font-weight="600">INDONESIA</text>
                            </svg>
                        </div>
                        <div class="kontak-map__card-footer">
                            <i class="fa-solid fa-earth-asia"></i>
                            <span>Melayani seluruh Indonesia secara online</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="kontak-cta">
        <div class="container">
            <div class="kontak-cta__box reveal-scale">
                <h2>Siap untuk Memulai?</h2>
                <p>Jangan tunda lagi. Hubungi kami sekarang dan mulai perjalanan digitalisasi nagari Anda hari ini.</p>
                <div class="kontak-cta__buttons">
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}?text=Halo%2C%20saya%20ingin%20memulai%20menggunakan%20Nagari%20Digital." target="_blank" class="btn btn--white btn--lg">
                        <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                    </a>
                    <a href="{{ route('harga') }}" class="btn btn--outline-white btn--lg">
                        <i class="fa-solid fa-tag"></i> Lihat Paket Harga
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection