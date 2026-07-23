@extends('layouts.app')

@section('title', 'The AXIO Method™ — Yalabikoglu & Co.')

@section('content')

<!-- Header Band (Ink Ground, No Photo) -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-7xl mx-auto w-full z-10 relative">
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                Proprietary Methodology
            </span>
        </div>
        <h1 class="font-heading text-[clamp(36px,5.5vw,72px)] tracking-tight leading-[1.08] font-semibold text-bone mb-6 reveal-on-scroll">
            The AXIO Method™
        </h1>
        <p class="text-base text-body-text-invert leading-relaxed max-w-xl reveal-on-scroll">
            Communication as Strategic Infrastructure.
        </p>
    </div>
</section>

<!-- Introduction Section -->
<section class="py-20 px-6 md:px-12 bg-bone text-ink border-b border-hairline">
    <div class="max-w-4xl mx-auto reveal-on-scroll">
        <p class="font-heading text-lg md:text-xl text-body-text leading-relaxed font-light italic">
            Advisory work built on a proprietary methodology integrating behavioural intelligence, communication axiology, executive positioning, personal architecture and narrative design into one strategic framework — developing the deeper systems that shape how leaders are perceived, trusted and remembered, rather than isolated presentation tactics.
        </p>
    </div>
</section>

<!-- The Four Dimensions Section -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-grey text-[10px] font-bold uppercase tracking-widest mb-16 reveal-on-scroll">
            The Four Dimensions
        </h2>
        
        @if($dimensions->isEmpty())
            <div class="py-12 border-t border-hairline text-center text-grey">
                <p>No dimensions published in database. Please run seeders.</p>
            </div>
        @else
            <div class="flex flex-col border-t border-hairline">
                @foreach($dimensions as $dimension)
                    <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-12 gap-8 py-10 border-b border-hairline items-start">
                        <!-- Large Ghost Numeral -->
                        <span class="col-span-1 md:col-span-2 font-heading text-[clamp(44px,6vw,72px)] font-bold text-grey/20 leading-none select-none tracking-tighter pt-1">
                            0{{ $loop->iteration }}
                        </span>
                        
                        <!-- Dimension Details -->
                        <div class="col-span-1 md:col-span-10">
                            <h3 class="font-heading text-xl md:text-2xl font-semibold mb-4 leading-snug">
                                {{ $dimension->translate()?->title }}
                            </h3>
                            <p class="text-sm md:text-base text-body-text leading-relaxed font-sans max-w-2xl">
                                {{ $dimension->translate()?->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<x-closing-cta />

@endsection
