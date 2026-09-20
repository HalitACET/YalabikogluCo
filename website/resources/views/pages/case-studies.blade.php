@extends('layouts.app')

@section('title', (page_meta('case-studies')?->meta_title ?: 'Case Studies & Endorsements') . ' — Yalabikoglu & Co.')
@section('meta_description', page_meta('case-studies')?->meta_description)

@section('content')

<!-- Header Band -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-7xl mx-auto w-full z-10 relative">
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                {{ __('Executive Proof') }}
            </span>
        </div>
        <h1 class="font-heading text-[clamp(36px,5.5vw,72px)] tracking-tight leading-[1.08] font-semibold text-bone mb-6 reveal-on-scroll">
            {!! __('Case Studies & Endorsements') !!}
        </h1>
        <p class="text-base text-body-text-invert leading-relaxed max-w-xl reveal-on-scroll">
            {{ __('Case studies dek') }}
        </p>
    </div>
</section>

<!-- Metrics Row -->
<section class="py-16 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-7xl mx-auto">
        @if($metrics->isEmpty())
            <div class="text-center text-grey py-6">
                <p>{{ __('No metrics published in database. Please run seeders.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                @foreach($metrics as $metric)
                    <div class="reveal-on-scroll p-4">
                        <span class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight block mb-2">
                            {{ $metric->value }}
                        </span>
                        <span class="text-[10px] uppercase tracking-widest text-grey font-semibold block">
                            {{ $metric->translate()?->label }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Featured Case Study ( Thomas M., Copenhagen ) -->
@if($featuredTestimonial)
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <span class="text-[10px] text-grey uppercase tracking-widest font-bold block mb-8">{{ __('Featured Case Study') }}</span>
        <p class="font-heading text-[clamp(20px,3vw,32px)] leading-relaxed italic mb-8">
            "{{ $featuredTestimonial->translate()?->quote }}"
        </p>
        
        <!-- Hairline Separator -->
        <div class="h-px bg-hairline-invert w-12 mx-auto my-6 opacity-30"></div>
        
        <!-- Stacked Attribution -->
        <div class="text-xs uppercase tracking-widest text-grey space-y-1">
            <span class="font-semibold text-bone block">{{ $featuredTestimonial->person_name }}</span>
            <span class="block text-[10px] mt-0.5">{{ $featuredTestimonial->role }}</span>
            <span class="block text-[10px]">{{ $featuredTestimonial->company }}</span>
            <span class="block text-[9px] text-grey/50 mt-1">— {{ $featuredTestimonial->city }}</span>
        </div>
    </div>
</section>
@else
<section class="bg-ink text-bone py-12 text-center">
    <p class="text-grey">{{ __('Featured case study not found in database.') }}</p>
</section>
@endif

<!-- Global Mandates (3x3 Grid) -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-16 reveal-on-scroll">
            {{ __('Global Mandates') }}
        </h2>
        
        @if($testimonials->isEmpty())
            <div class="text-center text-grey py-12 border border-dashed border-hairline">
                <p>{{ __('No published testimonials found. Please check database tables.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="reveal-on-scroll border border-hairline p-8 flex flex-col justify-between bg-bone min-h-[320px] hover:border-ink transition-colors duration-300">
                        <div>
                            <!-- Five Star Mark -->
                            <div class="text-xs text-ink/80 tracking-widest mb-6 font-semibold">
                                ★★★★★
                            </div>
                            
                            <!-- Quote -->
                            <p class="text-sm text-body-text leading-relaxed font-sans italic mb-8">
                                "{{ $testimonial->translate()?->quote }}"
                            </p>
                        </div>
                        
                        <!-- Pinned Attribution at Bottom -->
                        <div class="border-t border-hairline pt-4 flex justify-between items-end text-xs">
                            <div>
                                <span class="font-semibold text-ink block">{{ $testimonial->person_name }}</span>
                                <span class="text-grey block text-[10px] uppercase tracking-wider mt-0.5">
                                    {{ $testimonial->role }}@if($testimonial->company), {{ $testimonial->company }}@endif
                                </span>
                            </div>
                            <span class="text-[10px] text-grey uppercase tracking-widest font-mono ml-4 shrink-0">
                                {{ $testimonial->city }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<x-closing-cta />

@endsection
