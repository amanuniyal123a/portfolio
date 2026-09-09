@props(['skill'])

<div class="skill-card reveal">
    <div class="skill-top">
        <x-portfolio.ui.tech-icon :name="$skill['name']" color="var(--accent)" :size="22" />
        <span class="skill-name">{{ $skill['name'] }}</span>
        <span class="skill-pct" data-level="{{ $skill['level'] }}">0%</span>
    </div>
    <div class="skill-bar"><span class="skill-bar-fill" data-level="{{ $skill['level'] }}"></span></div>
</div>
