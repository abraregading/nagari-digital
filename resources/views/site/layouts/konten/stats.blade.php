<section class="stats">
    <div class="container">
        <div class="stats__grid stagger">
            @foreach($stats as $stat)
            <div class="stats__card reveal">
                <div class="stats__number" data-count="{{ $stat->count }}" data-suffix="{{ $stat->suffix }}">0</div>
                <div class="stats__label">{{ $stat->label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
