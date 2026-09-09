@props(['contact', 'socialLinks'])

@php
    $socials = collect($socialLinks)->filter(fn($s) => $s['is_enabled'])->sortBy('sort_order')->values();
@endphp

<section class="section" id="contact">
    <div class="container contact-grid">
        <div>
            <div class="eyebrow reveal">Let's Work Together</div>
            <h2 class="contact-heading reveal">
                {{ $contact['heading_pre'] }}<br>
                <span class="hl">{{ $contact['heading_hl'] }}</span> {{ $contact['heading_post'] }}
            </h2>

            <div class="contact-info-row reveal"><span class="ico"><x-portfolio.ui.icon name="email" /></span>{{ $contact['email'] }}</div>
            <div class="contact-info-row reveal"><span class="ico"><x-portfolio.ui.icon name="pin" /></span>{{ $contact['location'] }}</div>
            <div class="contact-info-row reveal"><span class="ico"><x-portfolio.ui.icon name="phone" /></span>{{ $contact['phone'] }}</div>

            <div class="contact-socials reveal">
                @foreach($socials as $social)
                    <x-portfolio.ui.social-icon :social="$social" context="contact" />
                @endforeach
            </div>
        </div>

        <form id="contact-form" class="reveal" data-testid="contact-form" method="POST" action="{{ url('/contact') }}">
            @csrf
            <div class="form-row">
                <input class="field" type="text" name="name" placeholder="Your Name" required data-testid="contact-name">
                <input class="field" type="email" name="email" placeholder="Your Email" required data-testid="contact-email">
            </div>
            <textarea class="field" name="message" placeholder="Your Project / Message" required data-testid="contact-message"></textarea>
            <button type="submit" class="submit-btn" data-testid="contact-submit" data-magnetic>SEND MESSAGE <x-portfolio.ui.icon name="send" /></button>
            <div class="form-status" id="form-status" data-testid="form-status"></div>
        </form>
    </div>
</section>
