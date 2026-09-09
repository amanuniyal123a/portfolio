@props(['project', 'index'])

<div class="project-card" data-tilt>
    <div class="project-thumb">
        <span class="project-num">0{{ $index + 1 }}</span>
        <img src="{{ $project['thumbnail'] }}" alt="{{ $project['title'] }}" loading="lazy">
    </div>
    <div class="project-body">
        <div class="project-title">
            {{ $project['title'] }}
            <x-portfolio.ui.icon name="externalLink" />
        </div>
        <p class="project-desc">{{ $project['short_description'] }}</p>
        <div class="project-tags">
            @foreach($project['technologies'] as $tech)
                <span class="tag-chip">
                    <x-portfolio.ui.tech-icon :name="$tech" color="var(--text-tertiary)" :size="14" />
                    {{ $tech }}
                </span>
            @endforeach
        </div>
    </div>
</div>
