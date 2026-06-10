<section class="products" id="products">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Produk Kami</span>
            <h2>5 Aplikasi dalam Satu Platform</h2>
            <p>Semua kebutuhan digitalisasi Desa/Nagari Anda tersedia dalam satu ekosistem yang saling terintegrasi.</p>
        </div>

        @php $chunks = $products->split(2); @endphp

        @foreach($chunks as $chunk)
        <div class="products__grid stagger">
            @foreach($chunk as $product)
            <div class="product-card reveal">
                <div class="product-card__icon">
                    <i class="fa-solid {{ $product->icon }}"></i>
                </div>
                <h3 class="product-card__title">{{ $product->title }}</h3>
                <p class="product-card__desc">{{ $product->description }}</p>
                <ul class="product-card__features">
                    @foreach($product->features as $feature)
                    <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
                <a href="{{ $product->link }}" class="product-card__link">
                    Pelajari Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>
