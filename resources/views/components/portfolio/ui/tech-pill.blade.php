@props(['technology'])

<div class="tech-pill">
    <x-portfolio.ui.tech-icon :name="$technology['name']" :color="$technology['bg'] ?? null" :size="18" />
    {{ $technology['name'] }}
</div>
