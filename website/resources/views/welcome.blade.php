@extends('layouts.app')

@section('title', 'Yalabikoglu & Co. — Placeholder')

@section('content')
<section class="max-w-4xl mx-auto py-24 px-6 md:px-12 text-center min-h-[120vh]">
    <div class="reveal-on-scroll">
        <h1 class="font-heading text-[clamp(32px,5vw,72px)] tracking-tight leading-none mb-6">
            Executive Communication Axiology
        </h1>
        <p class="text-base text-grey leading-relaxed mb-12 max-w-xl mx-auto">
            We align language, behaviour, and values into a coherent executive identity. This placeholder view confirms that the base shell layout, typography, navigation, and brand elements are successfully configured.
        </p>
    </div>
    
    <!-- Test Image with Grayscale Filter -->
    <div class="max-w-lg mx-auto reveal-on-scroll mt-12">
        <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=800&q=80" 
             alt="Test Executive Presence" 
             class="w-full aspect-[16/9] object-cover" />
        <span class="text-[10px] text-grey uppercase tracking-widest mt-3 block">
            Test Image (Hover to reveal color / Grayscale filter active)
        </span>
    </div>

    <!-- Extra space to test scroll height and sticky bar -->
    <div class="h-[80vh] flex items-center justify-center">
        <p class="text-xs uppercase tracking-widest text-grey">Scroll down further to trigger the sticky conversion bar</p>
    </div>
</section>
@endsection