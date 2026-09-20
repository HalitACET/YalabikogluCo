@props([
    'heading' => null,
    'buttonText' => null,
    'link' => null
])

@php
    $heading = $heading ?? __('Initiate an Advisory Relationship');
    $buttonText = $buttonText ?? __('Request Executive Briefing');
    $link = $link ?? briefing_url();
@endphp

<section class="bg-ink text-bone py-24 px-6 md:px-12 text-center relative overflow-hidden border-t border-hairline-invert">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <p class="font-heading text-2xl md:text-3xl mb-8">
            {{ $heading }}
        </p>
        <a href="{{ $link }}" @if(briefing_url_is_external()) target="_blank" rel="noopener noreferrer" @endif
           class="bg-bone text-ink text-xs uppercase tracking-widest font-bold px-8 py-4 hover:bg-ink hover:text-bone border border-bone transition-all duration-300 inline-block whitespace-nowrap">
            {{ $buttonText }}
        </a>
    </div>
</section>
