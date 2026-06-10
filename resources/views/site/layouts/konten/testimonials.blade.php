<section class="testimonials section--dark" id="testimonials">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Testimoni</span>
            <h2>Dipercaya oleh Pemerintah Nagari/Desa</h2>
            <p>Apa kata mereka yang sudah menggunakan platform Nagari Digital.</p>
        </div>

        <div class="testimonials__grid stagger">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-card reveal">
                <div class="testimonial-card__stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($testimonial->rating))
                        <i class="fa-solid fa-star"></i>
                        @elseif($i - $testimonial->rating == 0.5)
                        <i class="fa-solid fa-star-half-stroke"></i>
                        @else
                        <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="testimonial-card__text">"{{ $testimonial->text }}"</p>
                <div class="testimonial-card__author">
                    <div class="testimonial-card__avatar">{{ $testimonial->avatar ?? substr($testimonial->name, 0, 2) }}</div>
                    <div class="testimonial-card__info">
                        <h4>{{ $testimonial->name }}</h4>
                        <p>{{ $testimonial->village }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
