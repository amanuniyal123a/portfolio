@props(['experience'])

<div class="timeline-item {{ $experience['is_active'] ? 'active' : '' }} reveal">
    <div class="timeline-node"></div>
    <div class="timeline-year">{{ $experience['year'] }}</div>
    <div class="timeline-role">{{ $experience['position'] }}</div>
    <div class="timeline-desc">{{ $experience['description'] }}</div>
</div>
