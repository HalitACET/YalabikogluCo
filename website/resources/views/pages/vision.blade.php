@extends('layouts.app')

@section('title', (page_meta('vision')?->meta_title ?: 'Vision & Values') . ' — Yalabikoglu & Co.')
@section('meta_description', page_meta('vision')?->meta_description)

@section('content')

<!-- Header Band -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-7xl mx-auto w-full z-10 relative">
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                {{ __('Philosophical Mandate') }}
            </span>
        </div>
        <h1 class="font-heading text-[clamp(36px,5.5vw,72px)] tracking-tight leading-[1.08] font-semibold text-bone mb-6 reveal-on-scroll">
            {{ __('Vision & Values') }}
        </h1>
        <p class="text-base text-body-text-invert leading-relaxed max-w-2xl reveal-on-scroll">
            {{ __('Vision page dek') }}
        </p>
    </div>
</section>

<!-- Mandate Section (Static Copy) -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('The Mandate') }}
        </h2>
        <p class="font-heading text-2xl md:text-3xl font-semibold mb-8 leading-snug">
            {{ __('A global market where strategic intellect is never diminished by suboptimal communication.') }}
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-body-text leading-relaxed font-sans mt-12">
            <p>
                {{ __('Mandate paragraph one') }}
            </p>
            <p>
                {{ __('Mandate paragraph two') }}
            </p>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-16 reveal-on-scroll">
            {{ __('Core Values') }}
        </h2>
        
        @if($values->isEmpty())
            <div class="py-12 border-t border-hairline text-center text-grey">
                <p>{{ __('No core values published in database. Please run seeders.') }}</p>
            </div>
        @else
            <div class="flex flex-col border-t border-hairline">
                @foreach($values as $value)
                    <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-6 py-8 border-b border-hairline items-start">
                        <!-- Ghost Numeral (~80px footprint on desktop) -->
                        <span class="col-span-1 md:col-span-2 font-mono text-grey/40 text-sm font-semibold pt-1">
                            0{{ $loop->iteration }}
                        </span>
                        
                        <!-- Title -->
                        <h3 class="col-span-1 md:col-span-4 font-heading text-lg font-semibold leading-snug">
                            {{ $value->translate()?->title }}
                        </h3>
                        
                        <!-- Description -->
                        <p class="col-span-1 md:col-span-6 text-sm text-body-text leading-relaxed font-sans">
                            {{ $value->translate()?->description }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Macro Vision Section & Pull-Quote -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-4xl mx-auto reveal-on-scroll mb-16">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-8">
            {{ __('Macro Vision') }}
        </h2>
        <h3 class="font-heading text-2xl font-semibold mb-6 leading-snug">
            {{ __('The Institutional Ripple Effect') }}
        </h3>
        <p class="text-sm md:text-base text-body-text leading-relaxed font-sans">
            {{ __('Institutional ripple effect body') }}
        </p>
    </div>
</section>

<!-- Macro Quote Block (Dark ground, Large Serif) -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <p class="font-heading text-[clamp(24px,3.5vw,36px)] leading-relaxed mb-8">
            {{ __('Vision page macro quote') }}
        </p>
        <span class="text-xs uppercase tracking-widest text-grey font-semibold">
            — Efe Yalabıkoğlu
        </span>
    </div>
</section>

<!-- Closing CTA (Override variant) -->
<x-closing-cta :heading="__('Shape Your Institutional Legacy')" />

@endsection
