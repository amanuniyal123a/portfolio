@props(['hero', 'heroElements', 'socialLinks'])

@php
    $el = $heroElements;
    $badges = collect($hero['badges'])->filter(fn($b) => $b['is_enabled'])->sortBy('sort_order')->values();
    $floatingIcons = collect($hero['floating_icons'])->filter(fn($i) => $i['is_enabled'])->values();
    $socials = collect($socialLinks)->filter(fn($s) => $s['is_enabled'])->sortBy('sort_order')->values();
@endphp

<section class="hero" id="hero">
    @if($el['background_glow'])
        <div class="hero-glow"></div>
    @endif

    <div class="container">
        @if($el['social_links'])
            <div class="social-rail">
                @foreach($socials as $social)
                    <x-portfolio.ui.social-icon :social="$social" />
                @endforeach
            </div>
        @endif

        <div class="hero-inner">
            <div class="hero-copy">
                @if($el['greeting'])
                    <div class="hero-greeting">{{ $hero['greeting'] }}</div>
                @endif

                @if($el['headline'])
                    <h1 class="hero-headline">
                        <span class="hl-row"><span class="line-text">{{ $hero['headline_line1'] }}</span></span><br>
                        <span class="hl-row outline"><span class="line-text">{{ $hero['headline_line2'] }}</span></span>
                    </h1>
                @endif

                @if($el['description'])
                    <p class="hero-role">
                        {{ $hero['description_pre'] }}
                        <span class="hl">{{ $hero['description_hl1'] }}</span>
                        {{ $hero['description_mid'] }}
                        <span class="hl">{{ $hero['description_hl2'] }}</span>
                        {{ $hero['description_post'] }}
                    </p>
                @endif

                @if($el['technology_badges'])
                    <div class="badges">
                        @foreach($badges as $badge)
                            <x-portfolio.ui.badge :badge="$badge" />
                        @endforeach
                    </div>
                @endif

                <div class="hero-actions">
                    @if($el['primary_cta'] && $hero['cta_primary']['is_enabled'])
                        <x-portfolio.ui.button
                            :href="$hero['cta_primary']['url']"
                            :label="$hero['cta_primary']['label']"
                            variant="primary"
                            icon="arrowRight"
                            testid="hero-cta-primary"
                        />
                    @endif
                    @if($el['secondary_cta'] && $hero['cta_secondary']['is_enabled'])
                        <x-portfolio.ui.button
                            :href="$hero['cta_secondary']['url']"
                            :label="$hero['cta_secondary']['label']"
                            variant="outline"
                            icon="download"
                            testid="hero-cta-secondary"
                        />
                    @endif
                </div>
            </div>

            <div class="hero-visual">
                @if($el['orbit'])
                    <div class="orbit-ring r1"></div>
                    <div class="orbit-ring r2"></div>
                @endif

                @if($el['profile_image'])
                    <div class="hero-photo-wrap">
                        <img src="{{ $hero['profile_image'] }}" alt="{{ $hero['name'] }}" />
                    </div>
                @endif

                @if($el['floating_icons'])
                    @foreach($floatingIcons as $icon)
                        @php
                            $posStyle = isset($icon['right'])
                                ? "top:{$icon['top']};right:{$icon['right']};"
                                : "top:{$icon['top']};left:{$icon['left']};";
                        @endphp
                        <div class="float-icon" style="{{ $posStyle }}" data-float>
                            <x-portfolio.ui.tech-icon :name="$icon['label']" :color="$icon['bg']" :size="22" />
                            <span>{{ $icon['label'] }}</span>
                        </div>
                    @endforeach
                @endif

                @if($el['code_card'])
                    <div class="code-card">
                        <div class="dots"><span></span><span></span><span></span></div>
                        @foreach($hero['code_card_lines'] as $line)
                            <div class="line">{{ $line }}</div>
                        @endforeach
                        <div class="line"><span class="cursor-blink"></span></div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($el['scroll_indicator'])
        <div class="scroll-indicator"><span class="mouse"></span>SCROLL DOWN</div>
    @endif
</section>
