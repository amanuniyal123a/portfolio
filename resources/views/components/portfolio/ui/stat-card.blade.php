@props(['stat'])

<div class="stat-card">
    <div class="stat-value" data-count="{{ $stat['value'] }}">{{ $stat['value'] }}</div>
    <div class="stat-label">{{ $stat['label'] }}</div>
</div>
