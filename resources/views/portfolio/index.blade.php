@extends('layouts.portfolio')

@section('content')

    <x-portfolio.preloader :logo-text="$settings['logo_text']" />

    <x-portfolio.overlays.scroll-progress />
    <x-portfolio.overlays.noise />
    <x-portfolio.overlays.cursor />

    <x-portfolio.navigation.navbar
        :settings="$settings"
        :navigation="$navigation"
    />

    <x-portfolio.navigation.mobile-menu
        :navigation="$navigation"
        :social-links="$socialLinks"
        :contact-email="$contact['email']"
    />

    <main id="app">
        {{--
            Section registry loop — the Blade equivalent of the original
            `sectionRenderers` map. Only sections present, enabled, and
            ordered in $sections (from the controller / future
            portfolio_sections table) are rendered, in sort_order.
        --}}
        @php
            $activeSections = collect($sections)
                ->filter(fn($s) => $s['is_enabled'])
                ->sortBy('sort_order')
                ->values();

            $technologyGroups = collect($technologyGroups)->keyBy('key');
        @endphp

        @foreach($activeSections as $section)
            @switch($section['key'])
                @case('hero')
                    <x-portfolio.sections.hero
                        :hero="$hero"
                        :hero-elements="$heroElements"
                        :social-links="$socialLinks"
                    />
                    @break

                @case('worked_with')
                    <x-portfolio.sections.marquee :group="$technologyGroups['worked_with']" />
                    @break

                @case('expanding')
                    <x-portfolio.sections.marquee :group="$technologyGroups['expanding']" />
                    @break

                @case('about')
                    <x-portfolio.sections.about :about="$about" :stats="$stats" />
                    @break

                @case('skills')
                    <x-portfolio.sections.skills :skills="$skills" />
                    @break

                @case('projects')
                    <x-portfolio.sections.projects :projects="$projects" />
                    @break

                @case('experience')
                    <x-portfolio.sections.experience :experiences="$experiences" />
                    @break

                @case('testimonials')
                    <x-portfolio.sections.testimonials :testimonials="$testimonials" />
                    @break

                @case('contact')
                    <x-portfolio.sections.contact :contact="$contact" :social-links="$socialLinks" />
                    @break

                @case('footer')
                    <x-portfolio.sections.footer :footer="$footer" :social-links="$socialLinks" />
                    @break
            @endswitch
        @endforeach
    </main>

@endsection
