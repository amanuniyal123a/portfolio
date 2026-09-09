@props(['testimonial'])

<div class="testi-card reveal">
    <div class="testi-quote-mark">&quot;</div>
    <p class="testi-text">{{ $testimonial['testimonial'] }}</p>
    <div class="testi-person">
        <img class="testi-avatar" src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" loading="lazy">
        <div>
            <div class="testi-name">{{ $testimonial['name'] }}</div>
            <div class="testi-role">{{ $testimonial['designation'] }}, {{ $testimonial['company'] }}</div>
        </div>
    </div>
</div>
