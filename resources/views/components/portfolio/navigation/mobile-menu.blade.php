@props(['navigation', 'socialLinks', 'contactEmail'])

@php
    $items = collect($navigation)
        ->filter(fn($n) => $n['is_enabled'])
        ->sortBy('sort_order')
        ->values();

    $socials = collect($socialLinks)
        ->filter(fn($s) => $s['is_enabled'])
        ->sortBy('sort_order')
        ->values();
@endphp

<div class="mobile-menu" id="mobile-menu" data-testid="mobile-menu">
    <ul class="mobile-links" id="mobile-links">
        @foreach($items as $i => $item)
            <li>
                <a href="#{{ $item['section_key'] }}"
                   data-key="{{ $item['section_key'] }}"
                   class="{{ $i === 0 ? 'active' : '' }}"
                   data-testid="mobile-nav-link-{{ $item['section_key'] }}"
                ><span class="idx">0{{ $i + 1 }}</span>{{ $item['label'] }}</a>
            </li>
        @endforeach
    </ul>

    <div class="mobile-menu-footer" id="mobile-socials">
        @foreach($socials as $social)
            <x-portfolio.ui.social-icon :social="$social" context="mobile" />
        @endforeach
    </div>

    <div class="mobile-menu-email" id="mobile-email">{{ $contactEmail }}</div>
</div>
