<section class="why" id="why">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Kenapa Kami</span>
            <h2>Mengapa Memilih Nagari Digital?</h2>
            <p>Kami hadir dengan solusi yang dirancang khusus untuk kebutuhan pemerintahan Nagari/Desa di Indonesia.</p>
        </div>

        <div class="why__grid stagger">
            @foreach($whyChooseUs as $why)
            <div class="why__card reveal">
                <div class="why__card-icon">
                    <i class="fa-solid {{ $why->icon }}"></i>
                </div>
                <h3>{{ $why->title }}</h3>
                <p>{{ $why->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
