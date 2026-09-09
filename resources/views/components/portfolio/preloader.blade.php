@props(['logoText'])

<div id="preloader" data-testid="preloader">
    <div class="pre-inner">
        <div class="pre-logo">{{ $logoText }}</div>
        <div class="pre-bar"><span id="pre-fill"></span></div>
        <div class="pre-pct" id="pre-pct">0%</div>
    </div>
</div>
