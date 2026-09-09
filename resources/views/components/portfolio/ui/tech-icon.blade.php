@props([
    'name',
    'color' => null, // fallback dot color if no brand logo is mapped
    'size' => 18,
])

@php
    // Presentation-only lookup (brand slug for cdn.simpleicons.org), mirrors the
    // original techMeta object. Kept local to this component — no business logic.
    $techMeta = [
        'PHP'         => ['slug' => 'php'],
        'Laravel'     => ['slug' => 'laravel'],
        'MySQL'       => ['slug' => 'mysql'],
        'JavaScript'  => ['slug' => 'javascript'],
        'Node.js'     => ['slug' => 'nodedotjs'],
        'Next.js'     => ['slug' => 'nextdotjs', 'color' => 'ffffff'],
        'Git'         => ['slug' => 'git'],
        'jQuery'      => ['slug' => 'jquery'],
        'Docker'      => ['slug' => 'docker'],
        'AWS'         => ['slug' => 'amazonwebservices'],
        'TypeScript'  => ['slug' => 'typescript'],
        'Redis'       => ['slug' => 'redis'],
        'GraphQL'     => ['slug' => 'graphql'],
        'Supabase'    => ['slug' => 'supabase'],
        'Kubernetes'  => ['slug' => 'kubernetes'],
        'GitHub'      => ['slug' => 'github', 'color' => 'ffffff'],
        'LinkedIn'    => ['slug' => 'linkedin'],
        'X/Twitter'   => ['slug' => 'x', 'color' => 'ffffff'],
    ];

    $meta = $techMeta[$name] ?? null;
    $fallbackColor = $color ?: 'var(--accent)';
    $fallbackSize = max($size * 0.4, 7);
@endphp

@if(!$meta)
    <span class="tech-icon-fallback" style="width:{{ $fallbackSize }}px;height:{{ $fallbackSize }}px;background:{{ $fallbackColor }}" aria-hidden="true"></span>
@else
    @php
        $src = 'https://cdn.simpleicons.org/' . $meta['slug'] . (isset($meta['color']) ? '/' . $meta['color'] : '');
    @endphp
    <span class="tech-icon-wrap" style="width:{{ $size }}px;height:{{ $size }}px;">
        <img class="tech-icon" src="{{ $src }}" alt="{{ $name }} logo" width="{{ $size }}" height="{{ $size }}" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
        <span class="tech-icon-fallback" style="display:none;width:{{ $fallbackSize }}px;height:{{ $fallbackSize }}px;background:{{ $fallbackColor }}" aria-hidden="true"></span>
    </span>
@endif
