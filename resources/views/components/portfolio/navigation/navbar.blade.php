@props(['settings', 'navigation'])

@php
    $items = collect($navigation)
        ->filter(fn($n) => $n['is_enabled'])
        ->sortBy('sort_order')
        ->values();
@endphp

<nav class="navbar" id="navbar">
    <div class="container nav-inner">
        <a href="#hero" class="logo" id="nav-logo" data-testid="nav-logo">{{ $settings['logo_text'] }}</a>

        <ul class="nav-links" id="nav-links">
            @foreach($items as $i => $item)
                <li>
                    <a href="#{{ $item['section_key'] }}"
                       class="{{ $i === 0 ? 'active' : '' }}"
                       data-key="{{ $item['section_key'] }}"
                       data-testid="nav-link-{{ $item['section_key'] }}"
                    >{{ strtoupper($item['label']) }}</a>
                </li>
            @endforeach
        </ul>

        <a href="#contact" class="nav-cta" id="nav-cta" data-testid="nav-cta" data-magnetic>Let's Talk &#8599;</a>

        <button class="nav-toggle" id="nav-toggle" data-testid="nav-toggle" aria-label="Menu" aria-expanded="false"><span></span></button>
    </div>
</nav>
