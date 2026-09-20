@extends('layouts.app')

@section('title', 'Yalabikoglu & Co. — ' . (page_meta('home')?->meta_title ?: 'Executive Communication Axiology'))
@section('meta_description', page_meta('home')?->meta_description)

@section('content')

@php
    // Dynamically query database content
    $metrics = \App\Models\Metric::whereIn('placement', ['home', 'both'])
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->get();

    $disciplines = \App\Models\Discipline::where('is_published', true)
        ->orderBy('sort_order')
        ->take(2)
        ->get();

    $testimonials = \App\Models\Testimonial::where('placement', 'home')
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->get();
@endphp

<!-- 1. HERO SECTION (Full-bleed Darkened B&W Background) -->
<section class="relative min-h-[90vh] flex items-center px-6 md:px-12 py-24 bg-ink text-bone border-b border-hairline-invert overflow-hidden">
    <!-- Background B&W Photo with Dark Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero-home.jpg') }}"
             alt="" aria-hidden="true" 
             class="w-full h-full object-cover filter grayscale contrast-125" />
        <div class="absolute inset-0 bg-ink/75 pointer-events-none"></div>
    </div>
    
    <!-- Hero Overlaid Content -->
    <div class="relative z-10 max-w-7xl mx-auto w-full">
        <!-- Pulsing Availability Status -->
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                {{ __('Available for Remote Coaching') }}
            </span>
        </div>

        <!-- Main Heading -->
        <h1 class="font-heading text-[clamp(38px,6.2vw,84px)] tracking-tight leading-[1.05] font-semibold text-bone mb-6 reveal-on-scroll">
            {!! __('Transform the way you communicate, lead & grow') !!}
        </h1>

        <!-- Supporting copy -->
        <div class="max-w-2xl space-y-4 mb-10 reveal-on-scroll">
            <p class="text-base md:text-lg text-body-text-invert leading-relaxed">
                {{ __('Hero dek one') }}
            </p>
            <p class="text-sm md:text-base text-body-text-invert leading-relaxed">
                {{ __('Hero dek two') }}
            </p>
        </div>

        <!-- Hero Action Buttons -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 reveal-on-scroll">
            <a href="{{ briefing_url() }}" @if(briefing_url_is_external()) target="_blank" rel="noopener noreferrer" @endif
               class="bg-bone text-ink text-xs uppercase tracking-widest font-bold px-8 py-4 hover:bg-ink hover:text-bone border border-bone transition-all duration-300 text-center">
                {{ __('Request Executive Briefing') }}
            </a>
            <a href="{{ locale_route('axio-method') }}" class="text-xs uppercase tracking-widest font-semibold hover:opacity-60 transition-opacity border-b border-bone py-2 text-center text-bone">
                {{ __('Explore The AXIO Method™') }}
            </a>
        </div>
    </div>
</section>

<!-- 2. METRICS SECTION -->
@if($metrics->isNotEmpty())
<section class="border-b border-hairline py-20 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
        @foreach($metrics as $metric)
            <div class="reveal-on-scroll flex flex-col space-y-3">
                <span class="text-[10px] text-grey uppercase tracking-widest font-bold">
                    {{ $metric->translate()?->label }}
                </span>
                <span class="font-heading text-2xl md:text-3xl font-semibold leading-tight tracking-tight">
                    {{ $metric->value }}
                </span>
                @if($metric->translate()?->detail)
                    <span class="text-xs text-body-text leading-relaxed max-w-xs">
                        {{ $metric->translate()->detail }}
                    </span>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- 3. EXECUTIVE PROFILE SECTION (True 2-Column Grid Layout) -->
<section class="border-b border-hairline py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-7xl mx-auto profile-grid">
        <!-- Profile Portrait -->
        <div class="reveal-on-scroll">
            <div class="relative aspect-[3/4] overflow-hidden bg-ink">
                <img src="{{ asset('images/efe-portrait.jpg') }}"
                     alt="{{ __('Efe Yalabikoglu, co-founder of Yalabikoglu & Co.') }}" 
                     class="w-full h-full object-cover grayscale-img" />
            </div>
        </div>

        <!-- Biyografi ve Metin -->
        <div class="reveal-on-scroll flex flex-col justify-center space-y-6">
            <span class="text-[10px] uppercase tracking-widest font-bold text-grey">{{ __('Advisory Profile') }}</span>
            <h2 class="font-heading text-3xl md:text-4xl font-semibold tracking-tight">
                Efe Yalabikoglu
            </h2>
            <p class="text-xs text-grey uppercase tracking-widest font-semibold leading-none">
                {{ __('Co-Founder') }}
            </p>
            <div class="h-px bg-hairline w-12"></div>
            <p class="text-base text-body-text leading-relaxed font-sans max-w-xl">
                {{ __('Profile lead') }}
            </p>
            <p class="text-sm text-body-text leading-relaxed font-sans max-w-xl">
                {{ __('Profile experience') }}
            </p>
        </div>
    </div>

    {{-- The rest of the profile runs full width below the portrait: at this
         length it reads as an essay, not as a caption beside a photograph. --}}
    <div class="max-w-7xl mx-auto mt-16 md:mt-20">
        <div class="max-w-3xl space-y-6 text-sm md:text-base text-body-text leading-relaxed font-sans reveal-on-scroll">
            <p>{{ __('Profile approach') }}</p>
            <p>{{ __('Profile focus') }}</p>
            <p>{{ __('Profile scope') }}</p>
            <p>{{ __('Profile current') }}</p>
        </div>

        <!-- Where the method comes from -->
        <div class="max-w-3xl mt-14 pt-10 border-t border-hairline reveal-on-scroll">
            <p class="font-heading text-xl md:text-2xl font-semibold leading-snug mb-5">
                {{ __('Profile axio origin') }}
            </p>
            <p class="font-heading text-base md:text-lg italic text-grey leading-relaxed mb-5">
                {{ __('Profile axio negation') }}
            </p>
            <p class="text-sm md:text-base text-body-text leading-relaxed font-sans">
                {{ __('Profile axio definition') }}
            </p>
        </div>
    </div>
</section>

<!-- 4. DISCIPLINES TEASER SECTION -->
<section class="border-b border-hairline py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-7xl mx-auto">
        <div class="mb-16 reveal-on-scroll">
            <h2 class="font-heading text-3xl md:text-4xl font-semibold tracking-tight">
                {{ __('Four Systems. One Communication Architecture.') }}
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Dynamic Discipline Cards -->
            @foreach($disciplines as $discipline)
                <div class="reveal-on-scroll border border-hairline p-8 flex flex-col justify-between min-h-[350px] bg-bone hover:border-ink transition-colors duration-300">
                    <div>
                        <span class="text-[10px] text-grey font-mono block mb-6">0{{ $loop->iteration }}</span>
                        <h3 class="font-heading text-xl font-semibold mb-4 leading-snug">
                            {{ $discipline->translate()?->title }}
                        </h3>
                        <p class="text-sm text-body-text leading-relaxed font-sans mb-6">
                            {{ $discipline->translate()?->dek }}
                        </p>
                    </div>
                    @if($discipline->translate()?->pull_quote)
                        <div class="border-t border-hairline pt-4 text-xs italic text-grey font-heading">
                            "{{ $discipline->translate()?->pull_quote }}"
                        </div>
                    @endif
                </div>
            @endforeach

            <!-- Static Teaser Card -->
            <div class="reveal-on-scroll border border-hairline p-8 flex flex-col justify-between min-h-[350px] bg-ink text-bone">
                <div>
                    <span class="text-4xl lg:text-5xl font-heading text-grey/30 block mb-6 font-semibold">03·04</span>
                    <h3 class="font-heading text-xl font-semibold mb-4 leading-snug">
                        {{ __('Two more disciplines shape the full method.') }}
                    </h3>
                </div>
                <div class="pt-6">
                    <a href="{{ locale_route('disciplines') }}" class="text-xs uppercase tracking-widest font-bold border-b border-bone pb-2 hover:opacity-75 transition-opacity">
                        {{ __('View All Disciplines →') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PHILOSOPHY QUOTE SECTION (Dark Ground, Large Serif) -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <p class="font-heading text-[clamp(24px,3.5vw,36px)] leading-relaxed mb-8">
            {{ __('Homepage philosophy quote') }}
        </p>
        <span class="text-xs uppercase tracking-widest text-grey font-semibold">
            — Efe Yalabıkoğlu
        </span>
    </div>
</section>

<!-- 5. CLIENT VOICES (TESTIMONIALS) SECTION -->
@if($testimonials->isNotEmpty())
<section class="py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 reveal-on-scroll gap-4">
            <div>
                <h2 class="font-heading text-3xl md:text-4xl font-semibold tracking-tight">
                    {{ __('Client Voices') }}
                </h2>
            </div>
            <a href="{{ locale_route('case-studies') }}" class="text-xs uppercase tracking-widest font-bold border-b border-ink pb-1 hover:opacity-60 transition-opacity">
                {{ __('View Full Case Studies →') }}
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="reveal-on-scroll border border-hairline p-8 flex flex-col justify-between bg-bone min-h-[280px]">
                    <p class="text-sm text-body-text leading-relaxed font-sans italic mb-8">
                        "{{ $testimonial->translate()?->quote }}"
                    </p>
                    <div class="border-t border-hairline pt-4 flex justify-between items-center text-xs">
                        <div>
                            <span class="font-semibold text-ink block">{{ $testimonial->person_name }}</span>
                            <span class="text-grey block text-[10px] uppercase tracking-wider mt-0.5">{{ $testimonial->role }}</span>
                        </div>
                        <span class="text-[10px] text-grey uppercase tracking-widest">{{ $testimonial->city }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection