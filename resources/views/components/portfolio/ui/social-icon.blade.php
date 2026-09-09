@props(['social', 'context' => null])

@php
    $nameMap = ['github' => 'GitHub', 'twitter' => 'X/Twitter'];
    $brandName = $nameMap[$social['platform']] ?? null;
    $testId = 'social-' . $social['platform'] . ($context ? '-' . $context : '');
@endphp

<a class="social-icon" href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}" data-testid="{{ $testId }}">
    @if($brandName)
        <x-portfolio.ui.tech-icon :name="$brandName" color="var(--text-secondary)" :size="18" />
    @else
        <x-portfolio.ui.icon :name="$social['platform']" />
    @endif
</a>
