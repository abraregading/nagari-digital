<section class="preview section--gray" id="preview">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Demo Langsung</span>
            <h2>Lihat Langsung Website Nagari</h2>
            <p>Preview website Nagari yang sudah berjalan dan digunakan oleh Nagari Kuamang Alai Ujung Gading.</p>
        </div>

        <div class="preview__browser reveal-scale">
            <div class="preview__browser-bar">
                <div class="preview__browser-dot preview__browser-dot--red"></div>
                <div class="preview__browser-dot preview__browser-dot--yellow"></div>
                <div class="preview__browser-dot preview__browser-dot--green"></div>
                <div class="preview__browser-url">
                    <i class="fa-solid fa-lock"></i>
                    {{ str_replace(['https://', 'http://'], '', $settings['demo_url'] ?? 'kuamangalai-ug.nagaridigital.web.id') }}
                </div>
            </div>
            <iframe
                src="{{ $settings['demo_url'] ?? 'https://kuamangalai-ug.nagaridigital.web.id/' }}"
                class="preview__browser-frame"
                title="Preview Website Nagari"
                loading="lazy"
            ></iframe>
        </div>
    </div>
</section>
