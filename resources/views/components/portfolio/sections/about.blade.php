@props(['about', 'stats'])

@php
    $statItems = collect($stats)->filter(fn($s) => $s['is_enabled'])->sortBy('sort_order')->values();
    $codeLines = $about['code_lines'];
    $lastIndex = count($codeLines) - 1;
@endphp

<section class="section" id="about">
    <div class="container about-grid">
        <div>
            <div class="eyebrow reveal">{{ $about['eyebrow'] }}</div>
            <h2 class="about-heading reveal">
                {{ $about['heading_pre'] }}<br>
                {{ $about['heading_mid'] }}<br>
                <span class="hl">{{ $about['heading_hl'] }}</span>
            </h2>
            <p class="about-desc reveal">{{ $about['description'] }}</p>
            <div class="stats-row reveal">
                @foreach($statItems as $stat)
                    <x-portfolio.ui.stat-card :stat="$stat" />
                @endforeach
            </div>
        </div>

        <div class="about-code reveal" id="about-code">
            <div class="dots"><span></span><span></span><span></span></div>
            <div class="code-line"><span class="kw">const</span> aboutMe = &#123;</div>
            @foreach($codeLines as $i => $line)
                <div class="code-line">
                    <span class="ln">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>&nbsp;&nbsp;<span class="key">{{ $line['key'] }}</span>: <span class="str">{{ $line['value'] }}</span>{{ $i < $lastIndex ? ',' : '' }}
                </div>
            @endforeach
            <div class="code-line">&#125;;</div>
        </div>
    </div>
</section>
