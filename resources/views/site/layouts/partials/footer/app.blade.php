<div class="container">
    <div class="footer__grid">
        <div class="footer__brand">
            <h3>Nagari<span class="footer__brand-accent">Digital</span></h3>
            <p>{{ $settings['footer_desc'] ?? 'Platform digital terintegrasi untuk pemerintahan Nagari/Desa di seluruh Indonesia.' }}</p>
            <div class="footer__socials">
                <a href="{{ $settings['social_facebook'] ?? '#' }}" class="footer__social-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ $settings['social_instagram'] ?? '#' }}" class="footer__social-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $settings['social_youtube'] ?? '#' }}" class="footer__social-link" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}" target="_blank" class="footer__social-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="footer__col">
            <h4>Produk</h4>
            <ul>
                <li><a href="{{ route('fitur') }}#pelayanan">Pelayanan Kependudukan</a></li>
                <li><a href="{{ route('fitur') }}#jorong">Aplikasi Jorong</a></li>
                <li><a href="{{ route('fitur') }}#pendataan">Pendataan Penduduk</a></li>
                <li><a href="{{ route('fitur') }}#posyandu">Aplikasi Posyandu</a></li>
                <li><a href="{{ route('fitur') }}#website">Website Nagari</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h4>Halaman</h4>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('fitur') }}">Fitur</a></li>
                <li><a href="{{ route('demo') }}">Demo</a></li>
                <li><a href="{{ route('harga') }}">Harga</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h4>Kontak</h4>
            <ul>
                <li><i class="fa-brands fa-whatsapp"></i> <a href="https://wa.me/{{ $settings['whatsapp'] ?? '6282284186104' }}" target="_blank">{{ $settings['whatsapp'] ?? '0822-8418-6104' }}</a></li>
                <li><i class="fa-solid fa-envelope"></i> <a href="mailto:{{ $settings['email'] ?? 'info@nagaridigital.web.id' }}">{{ $settings['email'] ?? 'info@nagaridigital.web.id' }}</a></li>
                <li><i class="fa-solid fa-map-marker-alt"></i> {{ $settings['location'] ?? 'Sumatera Barat, Indonesia' }}</li>
            </ul>
        </div>
    </div>

    <div class="footer__bottom">
        <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Nagari Digital' }}. All Rights Reserved.</p>
        <div class="footer__bottom-links">
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat & Ketentuan</a>
        </div>
    </div>
</div>
