@props(['experiences'])

@php
    $items = collect($experiences)->filter(fn($e) => $e['is_enabled'])->sortBy('sort_order')->values();
@endphp

<section class="section" id="experience">
    <div class="container">
        <div class="eyebrow reveal">My Journey</div>
        <h2 class="section-title reveal" style="margin-bottom:56px;">Experience</h2>
        <div class="timeline">
            <div class="timeline-line-fill" id="tl-fill"></div>
            @foreach($items as $experience)
                <x-portfolio.ui.timeline-item :experience="$experience" />
            @endforeach
        </div>
    </div>
</section>
