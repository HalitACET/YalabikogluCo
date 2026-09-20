@extends('layouts.app')

@section('title', (page_meta('contact')?->meta_title ?: 'Contact') . ' — Yalabikoglu & Co.')
@section('meta_description', page_meta('contact')?->meta_description)

@section('content')

{{--
    Contact page — deliberately form-free.

    There is no <form>, no input, no POST target, no third-party embed and no
    tracking pixel on this page. Every channel below hands the conversation to
    the visitor's own mail client or to an external platform, so this site never
    receives or stores personal data. Do not add a form here without revisiting
    the KVKK/GDPR position first — see config/contact.php.
--}}

<!-- Header Band -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-7xl mx-auto w-full z-10 relative">
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                {{ __('Direct Correspondence') }}
            </span>
        </div>
        <h1 class="font-heading text-[clamp(36px,5.5vw,72px)] tracking-tight leading-[1.08] font-semibold text-bone mb-6 reveal-on-scroll">
            {!! __('Begin the Conversation') !!}
        </h1>
        <p class="text-base text-body-text-invert leading-relaxed max-w-xl reveal-on-scroll">
            {{ __('Contact page dek') }}
        </p>
    </div>
</section>

<!-- Direct Channels -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-16 reveal-on-scroll">
            {{ __('Direct Channels') }}
        </h2>

        <div class="flex flex-col border-t border-hairline">
            <!-- Email — the primary channel -->
            <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 py-8 border-b border-hairline items-baseline">
                <span class="col-span-1 md:col-span-3 text-[10px] text-grey uppercase tracking-widest font-semibold">
                    {{ __('Email') }}
                </span>
                <div class="col-span-1 md:col-span-9">
                    <a href="mailto:{{ $email }}"
                       class="font-heading text-xl md:text-2xl font-semibold leading-snug border-b border-ink pb-1 hover:opacity-60 transition-opacity break-all">
                        {{ $email }}
                    </a>
                    <p class="text-sm text-body-text leading-relaxed font-sans mt-4 max-w-xl">
                        {{ __('Email channel note') }}
                    </p>
                </div>
            </div>

            @if(config('contact.booking_url'))
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 py-8 border-b border-hairline items-baseline">
                    <span class="col-span-1 md:col-span-3 text-[10px] text-grey uppercase tracking-widest font-semibold">
                        {{ __('Scheduling') }}
                    </span>
                    <div class="col-span-1 md:col-span-9">
                        <a href="{{ config('contact.booking_url') }}" target="_blank" rel="noopener noreferrer"
                           class="font-heading text-xl md:text-2xl font-semibold leading-snug border-b border-ink pb-1 hover:opacity-60 transition-opacity">
                            {{ __('Book a briefing') }} ↗
                        </a>
                        <p class="text-sm text-body-text leading-relaxed font-sans mt-4 max-w-xl">
                            {{ __('Scheduling note') }}
                        </p>
                    </div>
                </div>
            @endif

            @if($phone)
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 py-8 border-b border-hairline items-baseline">
                    <span class="col-span-1 md:col-span-3 text-[10px] text-grey uppercase tracking-widest font-semibold">
                        {{ __('Telephone') }}
                    </span>
                    <div class="col-span-1 md:col-span-9">
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}"
                           class="font-heading text-xl md:text-2xl font-semibold leading-snug border-b border-ink pb-1 hover:opacity-60 transition-opacity">
                            {{ $phone }}
                        </a>
                    </div>
                </div>
            @endif

            @if($base)
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 py-8 border-b border-hairline items-baseline">
                    <span class="col-span-1 md:col-span-3 text-[10px] text-grey uppercase tracking-widest font-semibold">
                        {{ __('Base') }}
                    </span>
                    <div class="col-span-1 md:col-span-9">
                        <p class="font-heading text-xl md:text-2xl font-semibold leading-snug">
                            {{ $base }}
                        </p>
                        <p class="text-sm text-body-text leading-relaxed font-sans mt-4 max-w-xl">
                            {{ __('Base note') }}
                        </p>
                    </div>
                </div>
            @endif

            @if(!empty($social))
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 py-8 border-b border-hairline items-baseline">
                    <span class="col-span-1 md:col-span-3 text-[10px] text-grey uppercase tracking-widest font-semibold">
                        {{ __('Platforms') }}
                    </span>
                    <div class="col-span-1 md:col-span-9 flex flex-wrap gap-x-8 gap-y-3">
                        @foreach($social as $label => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                               class="text-xs uppercase tracking-widest font-bold border-b border-ink pb-1.5 hover:opacity-60 transition-opacity">
                                {{ $label }} ↗
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Before You Write — replaces the form fields without collecting anything -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8 reveal-on-scroll">
            {{ __('Before You Write') }}
        </h2>
        <p class="font-heading text-2xl md:text-3xl font-semibold mb-16 leading-snug reveal-on-scroll max-w-3xl">
            {{ __('Before you write lede') }}
        </p>

        @php
            $prompts = [
                ['title' => __('Your Mandate'), 'description' => __('Prompt mandate')],
                ['title' => __('Context'), 'description' => __('Prompt context')],
                ['title' => __('Horizon'), 'description' => __('Prompt horizon')],
                ['title' => __('Jurisdiction & Language'), 'description' => __('Prompt jurisdiction')],
            ];
        @endphp

        <div class="flex flex-col border-t border-hairline">
            @foreach($prompts as $prompt)
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-6 py-8 border-b border-hairline items-start">
                    <span class="col-span-1 md:col-span-2 font-mono text-grey/40 text-sm font-semibold pt-1">
                        0{{ $loop->iteration }}
                    </span>
                    <h3 class="col-span-1 md:col-span-4 font-heading text-lg font-semibold leading-snug">
                        {{ $prompt['title'] }}
                    </h3>
                    <p class="col-span-1 md:col-span-6 text-sm text-body-text leading-relaxed font-sans">
                        {{ $prompt['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Response Protocol -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('Response Protocol') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-body-text leading-relaxed font-sans">
            <p>{{ __('Response protocol paragraph one') }}</p>
            <p>{{ __('Response protocol paragraph two') }}</p>
        </div>
    </div>
</section>

<!-- Data Statement (Dark ground) — the reason this page has no form -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('On Your Data') }}
        </h2>
        <p class="font-heading text-[clamp(20px,3vw,32px)] leading-relaxed mb-10">
            {{ __('Data statement headline') }}
        </p>

        @php
            $dataPoints = [
                __('Data point no form'),
                __('Data point no cookies'),
                __('Data point no tracking'),
                __('Data point correspondence'),
            ];

            // The scheduling link leaves this site. Say so, rather than let the
            // list imply the visitor never reaches a third party at all.
            if (config('contact.booking_url')) {
                $dataPoints[] = __('Data point scheduling');
            }
        @endphp

        <ul class="flex flex-col border-t border-hairline-invert max-w-2xl">
            @foreach($dataPoints as $point)
                <li class="flex items-start gap-4 py-5 border-b border-hairline-invert text-sm text-body-text-invert leading-relaxed font-sans">
                    <span class="font-mono text-grey/60 text-xs pt-0.5 shrink-0">0{{ $loop->iteration }}</span>
                    <span>{{ $point }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<!-- Closing — mail CTA rather than the shared component, which points back here -->
<section class="bg-bone text-ink py-24 px-6 md:px-12 text-center">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <p class="font-heading text-2xl md:text-3xl mb-8">
            {{ __('Initiate an Advisory Relationship') }}
        </p>
        <a href="mailto:{{ $email }}"
           class="bg-ink text-bone text-xs uppercase tracking-widest font-bold px-8 py-4 hover:bg-bone hover:text-ink border border-ink transition-all duration-300 inline-block whitespace-nowrap">
            {{ __('Write Directly') }}
        </a>
    </div>
</section>

@endsection
