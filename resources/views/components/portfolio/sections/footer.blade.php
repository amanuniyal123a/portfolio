@props(['footer', 'socialLinks'])

@php
    $columns = collect($footer['columns'])->filter(fn($c) => $c['is_enabled'])->sortBy('sort_order')->values();
    $socials = collect($socialLinks)->filter(fn($s) => $s['is_enabled'])->sortBy('sort_order')->values();
@endphp

<footer id="footer">
    <div class="container">
        <div class="footer-top">
            <div>
                <div class="logo">{{ $footer['brand'] }}</div>
                <p class="footer-brand-desc">{{ $footer['description'] }}</p>

                <form class="footer-newsletter" id="newsletter-form" data-testid="newsletter-form" method="POST" action="{{ url('/newsletter') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required data-testid="newsletter-email">
                    <button aria-label="Subscribe" data-testid="newsletter-submit"><x-portfolio.ui.icon name="arrowRight" /></button>
                </form>
                <div class="footer-note" id="footer-note" data-testid="footer-note"></div>

                <div class="footer-socials-row">
                    @foreach($socials as $social)
                        <x-portfolio.ui.social-icon :social="$social" context="footer" />
                    @endforeach
                </div>
            </div>

            @foreach($columns as $column)
                @php
                    $links = collect($column['links'])->filter(fn($l) => $l['is_enabled'])->values();
                @endphp
                <div class="footer-col">
                    <div class="footer-col-title">{{ $column['title'] }}</div>
                    @foreach($links as $link)
                        <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="footer-bottom">
            <span>{{ $footer['copyright'] }}</span>
            <a href="#hero" class="back-to-top" data-testid="back-to-top">BACK TO TOP <x-portfolio.ui.icon name="arrowUp" /></a>
        </div>
    </div>
</footer>
