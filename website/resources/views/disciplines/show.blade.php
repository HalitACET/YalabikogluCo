@extends('layouts.app')

@section('title', $discipline->translate()?->title . ' — Yalabikoglu & Co.')
@section('meta_description', $discipline->translate()?->dek)

@section('content')

@php
    $slug = $discipline->slug;
    // Locally hosted fallbacks. Editors can override any of these by
    // attaching an image to the discipline in the admin panel. They are served
    // from our own origin on purpose — a remote image URL would hand the
    // visitor's IP address to a third party on every page view.
    $images = [
        'executive-presence' => asset('images/disciplines/executive-presence.jpg'),
        'executive-positioning' => asset('images/disciplines/executive-positioning.jpg'),
        'self-mastery' => asset('images/disciplines/self-mastery.jpg'),
        'strategic-messaging' => asset('images/disciplines/strategic-messaging.jpg'),
    ];
    $heroImage = $discipline->getFirstMediaUrl('images') ?: ($images[$slug] ?? $images['executive-presence']);

    // Generate ghost numeral
    $numeral = sprintf('%02d', $discipline->sort_order);

    $currentLocale = app()->getLocale();
    $routeName = ($currentLocale === 'en' ? '' : $currentLocale . '.') . 'disciplines.show';
@endphp

<!-- Header Band (Darkened B&W Photo background) -->
<section class="relative min-h-[60vh] flex items-center px-6 md:px-12 py-24 bg-ink text-bone border-b border-hairline-invert overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $heroImage }}" 
             alt="{{ $discipline->translate()?->title }}" 
             class="w-full h-full object-cover filter grayscale contrast-125 opacity-32" />
        <div class="absolute inset-0 bg-ink/80 pointer-events-none"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full flex flex-col md:flex-row justify-between items-start md:items-end gap-8">
        <div class="relative z-10 max-w-xl">
            <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
                <span class="status-dot"></span>
                <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                    {{ __('AXIO Method') }}
                </span>
            </div>
            <h1 class="font-heading text-[clamp(32px,5vw,64px)] tracking-tight leading-[1.1] font-semibold text-bone mb-6 reveal-on-scroll">
                {{ $discipline->translate()?->title }}
            </h1>
            <p class="text-base text-body-text-invert leading-relaxed reveal-on-scroll">
                {{ $discipline->translate()?->dek }}
            </p>
        </div>
        
        <!-- Oversized ghost numeral (Flows below text on mobile to prevent overlap, absolute on desktop) -->
        <div class="w-full md:w-auto flex justify-end md:block mt-6 md:mt-0 select-none z-0">
            <span class="font-heading text-[clamp(120px,20vw,280px)] font-bold text-bone/5 leading-none select-none tracking-tighter reveal-on-scroll md:absolute md:right-12 md:bottom-0 pointer-events-none">
                {{ $numeral }}
            </span>
        </div>
    </div>
</section>

<!-- Areas of Focus Section -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-16 reveal-on-scroll">
            {{ __('Areas of Focus') }}
        </h2>
        
        <div class="flex flex-col border-t border-hairline">
            @foreach($discipline->translate()?->areas_of_focus ?? [] as $index => $area)
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-6 py-8 border-b border-hairline items-start">
                    <!-- Ghost numeral -->
                    <span class="col-span-1 font-mono text-grey/40 text-sm font-semibold pt-1">
                        0{{ $index + 1 }}
                    </span>
                    
                    <!-- Title -->
                    <h3 class="col-span-4 font-heading text-lg font-semibold leading-snug">
                        {{ $area['title'] ?? '' }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="col-span-7 text-sm text-body-text leading-relaxed font-sans">
                        {{ $area['description'] ?? '' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Pull-quote Block (Dark ground, Large Serif) -->
@if($discipline->translate()?->pull_quote)
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <p class="font-heading text-[clamp(24px,3.5vw,36px)] leading-relaxed">
            "{{ $discipline->translate()?->pull_quote }}"
        </p>
    </div>
</section>
@endif

<!-- Circular Navigation (Continue the Method) -->
<section class="grid grid-cols-1 md:grid-cols-2 border-b border-hairline bg-bone text-ink">
    <!-- Previous Discipline -->
    @if($prevDiscipline)
        <a href="{{ route($routeName, ['slug' => $prevDiscipline->slug]) }}" 
           class="reveal-on-scroll group border-b md:border-b-0 md:border-r border-hairline p-12 md:p-16 flex flex-col justify-between hover:bg-ink hover:text-bone transition-all duration-500 min-h-[240px]">
            <span class="text-[10px] text-grey uppercase tracking-widest font-semibold group-hover:text-bone/60 transition-colors">{{ __('Previous Discipline') }}</span>
            <div class="mt-8">
                <span class="text-xs font-mono text-grey/60 block mb-2">0{{ $prevDiscipline->sort_order }}</span>
                <h3 class="font-heading text-2xl font-semibold leading-snug group-hover:translate-x-2 transition-transform duration-300">
                    ← {{ $prevDiscipline->translate()?->title }}
                </h3>
            </div>
        </a>
    @endif

    <!-- Next Discipline -->
    @if($nextDiscipline)
        <a href="{{ route($routeName, ['slug' => $nextDiscipline->slug]) }}" 
           class="reveal-on-scroll group p-12 md:p-16 flex flex-col justify-between hover:bg-ink hover:text-bone transition-all duration-500 min-h-[240px]">
            <span class="text-[10px] text-grey uppercase tracking-widest font-semibold text-right block group-hover:text-bone/60 transition-colors">{{ __('Next Discipline') }}</span>
            <div class="mt-8 text-right">
                <span class="text-xs font-mono text-grey/60 block mb-2">0{{ $nextDiscipline->sort_order }}</span>
                <h3 class="font-heading text-2xl font-semibold leading-snug group-hover:-translate-x-2 transition-transform duration-300">
                    {{ $nextDiscipline->translate()?->title }} →
                </h3>
            </div>
        </a>
    @endif
</section>

<x-closing-cta />

@endsection
