@props(['group'])

@php
    $items = collect($group['technologies'])->filter(fn($t) => $t['is_enabled'])->values();
@endphp

<section class="marquee-section" id="{{ $group['key'] }}">
    <div class="marquee-head">
        <span class="tag">{{ $group['title'] }}</span>
        <span class="title">{{ $group['subtitle'] }}</span>
    </div>
    <div class="marquee-viewport">
        <div class="marquee-track" data-speed="{{ $group['speed'] }}" data-reverse="{{ !empty($group['reverse']) ? 'true' : 'false' }}">
            @for($pass = 0; $pass < 2; $pass++)
                @foreach($items as $tech)
                    <x-portfolio.ui.tech-pill :technology="$tech" />
                    <span class="tech-sep">&#10022;</span>
                @endforeach
            @endfor
        </div>
    </div>
</section>
