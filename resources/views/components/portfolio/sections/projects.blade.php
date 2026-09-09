@props(['projects'])

@php
    $items = collect($projects)->filter(fn($p) => $p['is_enabled'])->sortBy('sort_order')->values();
@endphp

<section class="section" id="projects">
    <div class="container">
        <div class="section-head-row">
            <div>
                <div class="eyebrow reveal">My Projects</div>
                <h2 class="section-title reveal">Selected Work</h2>
            </div>
            <a href="#" class="view-all reveal">VIEW ALL PROJECTS <x-portfolio.ui.icon name="externalLink" /></a>
        </div>

        <div class="projects-track-wrap reveal">
            <div class="projects-track" id="projects-track" data-testid="projects-track">
                @foreach($items as $index => $project)
                    <x-portfolio.ui.project-card :project="$project" :index="$index" />
                @endforeach
            </div>
            <div class="carousel-nav">
                <button class="carousel-btn" id="proj-prev" data-testid="projects-prev" data-magnetic aria-label="Previous projects"><x-portfolio.ui.icon name="chevronLeft" /></button>
                <button class="carousel-btn" id="proj-next" data-testid="projects-next" data-magnetic aria-label="Next projects"><x-portfolio.ui.icon name="chevronRight" /></button>
            </div>
        </div>
    </div>
</section>
