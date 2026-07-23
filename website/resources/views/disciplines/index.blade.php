@extends('layouts.app')

@section('title', 'Disciplines — Yalabikoglu & Co.')

@section('content')

@php
    $currentLocale = app()->getLocale();
    $routeName = ($currentLocale === 'en' ? '' : $currentLocale . '.') . 'disciplines.show';
@endphp

<!-- Header Band (Ink Ground, No Photo) -->
<section class="bg-ink text-bone py-24 px-6 md:px-12 border-b border-hairline-invert relative overflow-hidden">
    <div class="max-w-7xl mx-auto w-full z-10 relative">
        <div class="flex items-center space-x-3 mb-6 reveal-on-scroll">
            <span class="status-dot"></span>
            <span class="text-[10px] uppercase tracking-widest font-semibold text-bone/60">
                The AXIO Method™
            </span>
        </div>
        <h1 class="font-heading text-[clamp(36px,5.5vw,72px)] tracking-tight leading-[1.08] font-semibold text-bone mb-6 reveal-on-scroll">
            Four Disciplines.<br>One Communication Architecture.
        </h1>
        <p class="text-base text-body-text-invert leading-relaxed max-w-xl reveal-on-scroll">
            Communication is rarely the constraint. Misalignment is.
        </p>
    </div>
</section>

<!-- Disciplines Grid Section -->
<section class="py-24 px-6 md:px-12 bg-bone text-ink">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @foreach($disciplines as $discipline)
                <div class="reveal-on-scroll border border-hairline p-8 md:p-12 flex flex-col justify-between min-h-[420px] bg-bone hover:border-ink transition-colors duration-300">
                    <div>
                        <!-- Numeral -->
                        <span class="text-[10px] text-grey font-mono block mb-8 font-semibold">0{{ $loop->iteration }}</span>
                        
                        <!-- Title -->
                        <h2 class="font-heading text-2xl font-semibold mb-4 leading-snug">
                            {{ $discipline->translate()?->title }}
                        </h2>
                        
                        <!-- Dek -->
                        <p class="text-sm text-body-text leading-relaxed font-sans mb-8">
                            {{ $discipline->translate()?->dek }}
                        </p>
                    </div>

                    <!-- Pull Quote & Explore Link -->
                    <div class="border-t border-hairline pt-6 flex flex-col space-y-6">
                        @if($discipline->translate()?->pull_quote)
                            <p class="text-xs italic text-grey font-heading">
                                "{{ $discipline->translate()?->pull_quote }}"
                            </p>
                        @endif
                        <div>
                            <a href="{{ route($routeName, ['slug' => $discipline->slug]) }}" 
                               class="text-xs uppercase tracking-widest font-bold border-b border-ink pb-1.5 hover:opacity-60 transition-opacity">
                                Explore Discipline →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<x-closing-cta />

@endsection
