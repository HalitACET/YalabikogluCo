@extends('layouts.app')

@section('title', (page_meta('privacy')?->meta_title ?: 'Privacy Policy') . ' — Yalabikoglu & Co.')
@section('meta_description', page_meta('privacy')?->meta_description)

@section('content')

{{--
    Privacy page.

    Every claim below is a statement about how this application actually
    behaves, not boilerplate. They are true because:

      - no cookies       → session/cookie middleware is stripped from the
                           public route group in bootstrap/app.php
      - no third parties → fonts are self-hosted at build time (vite.config.js),
                           Alpine is bundled into app.js, and all images are
                           served from public/images
      - no forms         → the contact page has no <form> and there is no POST
                           route on the public site

    If any of those change, change this page in the same commit.
--}}

<!-- Header Band -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-7xl mx-auto w-full z-10 relative">
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                {{ __('Data Position') }}
            </span>
        </div>
        <h1 class="font-heading text-[clamp(36px,5.5vw,72px)] tracking-tight leading-[1.08] font-semibold text-bone mb-6 reveal-on-scroll">
            {!! __('Privacy heading') !!}
        </h1>
        <p class="text-base text-body-text-invert leading-relaxed max-w-2xl reveal-on-scroll">
            {{ __('Privacy page dek') }}
        </p>
    </div>
</section>

<!-- The Short Version -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('The Short Version') }}
        </h2>
        <p class="font-heading text-2xl md:text-3xl font-semibold mb-8 leading-snug">
            {{ __('Privacy short version headline') }}
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-body-text leading-relaxed font-sans mt-12">
            <p>{{ __('Privacy short version paragraph one') }}</p>
            <p>{{ __('Privacy short version paragraph two') }}</p>
        </div>
    </div>
</section>

<!-- What This Site Does Not Do -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-16 reveal-on-scroll">
            {{ __('What This Site Does Not Do') }}
        </h2>

        @php
            $absences = [
                ['title' => __('No Cookies'), 'description' => __('Absence cookies')],
                ['title' => __('No Analytics'), 'description' => __('Absence analytics')],
                ['title' => __('No Forms'), 'description' => __('Absence forms')],
                ['title' => __('No Third-Party Requests'), 'description' => __('Absence third parties')],
                ['title' => __('No Accounts'), 'description' => __('Absence accounts')],
                ['title' => __('No Advertising'), 'description' => __('Absence advertising')],
            ];
        @endphp

        <div class="flex flex-col border-t border-hairline">
            @foreach($absences as $absence)
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-6 py-8 border-b border-hairline items-start">
                    <span class="col-span-1 md:col-span-2 font-mono text-grey/40 text-sm font-semibold pt-1">
                        0{{ $loop->iteration }}
                    </span>
                    <h3 class="col-span-1 md:col-span-4 font-heading text-lg font-semibold leading-snug">
                        {{ $absence['title'] }}
                    </h3>
                    <p class="col-span-1 md:col-span-6 text-sm text-body-text leading-relaxed font-sans">
                        {{ $absence['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        @if(config('contact.booking_url'))
            <p class="max-w-2xl mt-12 text-sm text-body-text leading-relaxed font-sans reveal-on-scroll">
                {{ __('Scheduling disclosure') }}
            </p>
        @endif
    </div>
</section>

<!-- Server Logs — the one honest exception -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('Server Logs') }}
        </h2>
        <p class="font-heading text-xl md:text-2xl font-semibold mb-8 leading-snug">
            {{ __('Server logs headline') }}
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-body-text leading-relaxed font-sans">
            <p>{{ __('Server logs paragraph one') }}</p>
            <p>{{ __('Server logs paragraph two') }}</p>
        </div>
    </div>
</section>

<!-- If You Write To Us -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('If You Write To Us') }}
        </h2>
        <p class="font-heading text-[clamp(20px,3vw,32px)] leading-relaxed mb-10">
            {{ __('Correspondence headline') }}
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-body-text-invert leading-relaxed font-sans">
            <p>{{ __('Correspondence paragraph one') }}</p>
            <p>{{ __('Correspondence paragraph two') }}</p>
        </div>
    </div>
</section>

<!-- Your Rights -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('Your Rights') }}
        </h2>
        <p class="text-sm text-body-text leading-relaxed font-sans max-w-2xl mb-8">
            {{ __('Your rights body') }}
        </p>
        <a href="mailto:{{ $email }}"
           class="text-xs uppercase tracking-widest font-bold border-b border-ink pb-1.5 hover:opacity-60 transition-opacity inline-block break-all">
            {{ $email }}
        </a>
    </div>
</section>

<!-- Changes -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('Changes To This Page') }}
        </h2>
        <p class="text-sm text-body-text leading-relaxed font-sans max-w-2xl">
            {{ __('Changes body') }}
        </p>
    </div>
</section>

@endsection
