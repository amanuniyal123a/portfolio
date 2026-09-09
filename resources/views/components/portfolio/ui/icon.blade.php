@props(['name'])

{{-- Preserves the exact SVG markup from the original Icons object --}}
@switch($name)
    @case('github')
        <svg viewBox="0 0 24 24" fill="currentColor" {{ $attributes }}><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.08 3.29 9.39 7.86 10.91.58.1.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.87-1.54-3.87-1.54-.53-1.33-1.29-1.69-1.29-1.69-1.05-.72.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.28-5.24-5.68 0-1.25.45-2.28 1.19-3.08-.12-.29-.52-1.46.11-3.05 0 0 .96-.31 3.16 1.18a10.9 10.9 0 0 1 5.75 0c2.2-1.49 3.16-1.18 3.16-1.18.63 1.59.23 2.76.11 3.05.74.8 1.19 1.83 1.19 3.08 0 4.41-2.69 5.38-5.25 5.67.41.36.78 1.07.78 2.15 0 1.56-.01 2.81-.01 3.19 0 .31.21.67.8.56A10.52 10.52 0 0 0 23.5 12C23.5 5.65 18.35.5 12 .5z"/></svg>
        @break
    @case('linkedin')
        <svg viewBox="0 0 24 24" fill="currentColor" {{ $attributes }}><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.34V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.38-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45z"/></svg>
        @break
    @case('email')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" {{ $attributes }}><path d="M3 5h18v14H3z"/><path d="M3 6l9 7 9-7"/></svg>
        @break
    @case('twitter')
        <svg viewBox="0 0 24 24" fill="currentColor" {{ $attributes }}><path d="M18.24 2H21l-6.6 7.54L22 22h-6.35l-4.97-6.5L4.9 22H2.13l7.06-8.07L2 2h6.5l4.5 5.94L18.24 2zm-1.12 18h1.86L7.98 4H6l11.12 16z"/></svg>
        @break
    @case('externalLink')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
        @break
    @case('arrowRight')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        @break
    @case('chevronLeft')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M15 18l-6-6 6-6"/></svg>
        @break
    @case('chevronRight')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M9 18l6-6-6-6"/></svg>
        @break
    @case('download')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M12 3v12m0 0l-4-4m4 4l4-4M4 21h16"/></svg>
        @break
    @case('send')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
        @break
    @case('pin')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" {{ $attributes }}><path d="M12 22s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
        @break
    @case('phone')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" {{ $attributes }}><path d="M22 16.9v2a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.7A2 2 0 014.1 1h2a2 2 0 012 1.7c.1 1 .3 2 .6 3a2 2 0 01-.5 2.1L7 9a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c1 .3 2 .5 3 .6a2 2 0 011.7 2z"/></svg>
        @break
    @case('arrowUp')
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes }}><path d="M12 19V5M5 12l7-7 7 7"/></svg>
        @break
@endswitch
