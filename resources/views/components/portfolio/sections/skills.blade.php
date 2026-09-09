@props(['skills'])

@php
    $items = collect($skills)->filter(fn($s) => $s['is_enabled'])->sortBy('sort_order')->values();
@endphp

<section class="section" id="skills">
    <div class="container">
        <div class="eyebrow reveal">My Skills</div>
        <h2 class="section-title reveal" style="margin-bottom:56px;">Technical Expertise</h2>
        <div class="skills-grid">
            @foreach($items as $skill)
                <x-portfolio.ui.skill-card :skill="$skill" />
            @endforeach
        </div>
    </div>
</section>
