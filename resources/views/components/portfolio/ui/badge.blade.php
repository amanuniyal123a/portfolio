@props(['badge'])

<div class="badge">
    <x-portfolio.ui.tech-icon :name="$badge['label']" color="var(--accent)" :size="18" />
    {{ $badge['label'] }}
</div>
