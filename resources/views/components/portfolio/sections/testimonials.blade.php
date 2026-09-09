@props(['testimonials'])

@php
    $items = collect($testimonials)->filter(fn($t) => $t['is_enabled'])->sortBy('sort_order')->values();
@endphp

<section class="section" id="testimonials">
    <div class="container">
        <div class="eyebrow reveal">Testimonials</div>
        <h2 class="section-title reveal" style="margin-bottom:56px;">What People Say</h2>

        <div class="testi-grid" id="testi-grid" data-testid="testi-grid">
            @foreach($items as $testimonial)
                <x-portfolio.ui.testimonial-card :testimonial="$testimonial" />
            @endforeach
        </div>

        <div class="testi-dots" id="testi-dots">
            @foreach($items as $i => $testimonial)
                <button class="{{ $i === 0 ? 'active' : '' }}" data-testid="testi-dot-{{ $i }}" aria-label="Go to testimonial {{ $i + 1 }}"></button>
            @endforeach
        </div>
    </div>
</section>
