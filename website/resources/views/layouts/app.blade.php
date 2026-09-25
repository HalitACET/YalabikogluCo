<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yalabikoglu & Co. — Executive Communication Axiology')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Premium executive presence and communication positioning advisory.')">

    {{-- Canonical: tells search engines which address is the real one for this
         page, so the same content reached by a different URL is not treated as
         a duplicate. --}}
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- SEO hreflang tags -->
    @hreflang

    {{-- Favicon and social preview. Served from our own origin like everything
         else, so sharing a link still leaks nothing to a third party. --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/brand/favicon-32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/brand/favicon-180.png') }}">

    <meta property="og:site_name" content="Yalabikoglu &amp; Co.">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ app()->getLocale() }}">
    <meta property="og:title" content="@yield('title', 'Yalabikoglu & Co.')">
    <meta property="og:description" content="@yield('meta_description', '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/hero-home.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- Fonts are self-hosted (see vite.config.js). No request ever leaves
         this origin, so no third party sees a visitor's IP address. --}}
    @fonts

    <!-- CSS & JS Assets (Alpine is bundled into app.js, not loaded from a CDN) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bone text-ink antialiased min-h-screen flex flex-col selection:bg-ink selection:text-bone">

    <!-- Navigation Header -->
    <header 
        x-data="{ 
            scrolled: false, 
            menuOpen: false 
        }"
        @scroll.window="scrolled = window.scrollY > 50"
        {{-- Every page opens on a dark section, so the resting header is
             transparent with light text and sits over it. On scroll it gains
             its own ink background. --}}
        :class="scrolled ? 'bg-ink text-bone py-4 border-b border-hairline-invert' : 'bg-transparent text-bone py-6'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out border-b border-transparent"
    >
        <div class="w-full px-6 md:px-12 flex justify-between items-center">
            <!-- Wordmark -->
            <a href="{{ locale_route('home') }}" class="font-heading text-lg md:text-xl tracking-wider font-semibold uppercase transition-colors whitespace-nowrap xl:mr-14">
                Yalabikoglu & Co.
            </a>

            <!-- Desktop Navigation -->
            @php
                $currentLocale = app()->getLocale();
                // Rota aktiflik kontrolleri
                $isHome = request()->routeIs('home') || request()->routeIs('*.home');
                $isDisciplines = request()->is('disciplines*') || request()->is('*/disciplines*');
                $isAxio = request()->is('axio-method*') || request()->is('*/axio-method*');
                $isCaseStudies = request()->is('case-studies*') || request()->is('*/case-studies*');
                $isVision = request()->is('vision*') || request()->is('*/vision*');
                $isContact = request()->is('contact*') || request()->is('*/contact*');
            @endphp
            <nav class="hidden xl:flex items-center space-x-6 text-xs uppercase tracking-widest font-medium">
                <a href="{{ locale_route('home') }}" class="transition-opacity whitespace-nowrap {{ $isHome ? 'opacity-55' : 'opacity-100 hover:opacity-55' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ locale_route('disciplines') }}" class="transition-opacity whitespace-nowrap {{ $isDisciplines ? 'opacity-55' : 'opacity-100 hover:opacity-55' }}">
                    {{ __('Disciplines') }}
                </a>
                <a href="{{ locale_route('axio-method') }}" class="transition-opacity whitespace-nowrap {{ $isAxio ? 'opacity-55' : 'opacity-100 hover:opacity-55' }}">
                    {{ __('AXIO Method') }}
                </a>
                <a href="{{ locale_route('case-studies') }}" class="transition-opacity whitespace-nowrap {{ $isCaseStudies ? 'opacity-55' : 'opacity-100 hover:opacity-55' }}">
                    {{ __('Case Studies') }}
                </a>
                <a href="{{ locale_route('vision') }}" class="transition-opacity whitespace-nowrap {{ $isVision ? 'opacity-55' : 'opacity-100 hover:opacity-55' }}">
                    {{ __('Vision & Values') }}
                </a>
                <a href="{{ locale_route('contact') }}" class="transition-opacity whitespace-nowrap {{ $isContact ? 'opacity-55' : 'opacity-100 hover:opacity-55' }}">
                    {{ __('Contact') }}
                </a>
            </nav>

            <!-- Language Switcher & Hamburger -->
            <div class="flex items-center space-x-6 xl:ml-12">
                <!-- Desktop Language Switcher -->
                <div class="hidden xl:flex items-center space-x-2 text-[10px] uppercase tracking-widest font-semibold">
                    @foreach(config('locales.supported', ['en' => 'English']) as $lang => $name)
                        <a href="{{ app(\App\Support\LocaleUrl::class)->for($lang) }}" 
                           class="transition-opacity whitespace-nowrap {{ $currentLocale === $lang ? 'opacity-100' : 'opacity-40 hover:opacity-100' }}">
                            {{ __($name) }}
                        </a>
                        @if(!$loop->last)<span class="opacity-20">/</span>@endif
                    @endforeach
                </div>

                <!-- Mobile Menu Button -->
                <button 
                    @click="menuOpen = !menuOpen" 
                    class="xl:hidden p-1 focus:outline-none"
                    aria-label="{{ __('Toggle menu') }}"
                >
                    <svg class="w-6 h-6 current-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!menuOpen" stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="menuOpen" style="display: none;" stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Full-Screen Mobile Menu Overlay -->
        <div 
            x-show="menuOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="fixed inset-0 z-40 bg-ink text-bone flex flex-col justify-between p-8 pt-24 xl:hidden"
            style="display: none;"
        >
            <nav class="flex flex-col space-y-6 text-2xl font-heading tracking-wide">
                <a @click="menuOpen = false" href="{{ locale_route('home') }}" class="hover:opacity-75 transition-opacity">{{ __('Home') }}</a>
                <a @click="menuOpen = false" href="{{ locale_route('disciplines') }}" class="hover:opacity-75 transition-opacity">{{ __('Disciplines') }}</a>
                <a @click="menuOpen = false" href="{{ locale_route('axio-method') }}" class="hover:opacity-75 transition-opacity">{{ __('AXIO Method') }}</a>
                <a @click="menuOpen = false" href="{{ locale_route('case-studies') }}" class="hover:opacity-75 transition-opacity">{{ __('Case Studies') }}</a>
                <a @click="menuOpen = false" href="{{ locale_route('vision') }}" class="hover:opacity-75 transition-opacity">{{ __('Vision & Values') }}</a>
                <a @click="menuOpen = false" href="{{ locale_route('contact') }}" class="hover:opacity-75 transition-opacity">{{ __('Contact') }}</a>
            </nav>

            <div class="border-t border-hairline-invert pt-6 flex flex-col space-y-4">
                <!-- Mobile Language Selector -->
                <div class="flex space-x-4 text-xs tracking-widest font-semibold uppercase">
                    @foreach(config('locales.supported', ['en' => 'English']) as $lang => $name)
                        <a @click="menuOpen = false" href="{{ app(\App\Support\LocaleUrl::class)->for($lang) }}" 
                           class="{{ $currentLocale === $lang ? 'text-bone' : 'text-grey hover:text-bone' }}">
                            {{ __($name) }}
                        </a>
                    @endforeach
                </div>
                <div class="text-[10px] text-grey uppercase tracking-widest">
                    Yalabikoglu & Co. © {{ date('Y') }}
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-ink text-bone border-t border-hairline-invert py-16 px-6 md:px-12 mt-auto">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand Column -->
            <div class="md:col-span-2 flex flex-col space-y-4">
                <span class="font-heading text-xl uppercase tracking-wider font-semibold">Yalabikoglu & Co.</span>
                <p class="text-xs text-grey max-w-sm leading-relaxed uppercase tracking-wider">
                    {{ __('Strategic Advisory & Executive Presence') }}
                </p>
            </div>

            <!-- Navigation Links (Database-Driven) -->
            @php
                $dbPages = \App\Models\Page::all();
                $slugTitles = [
                    'home' => 'Home',
                    'disciplines' => 'Disciplines',
                    'axio-method' => 'AXIO Method',
                    'case-studies' => 'Case Studies',
                    'vision' => 'Vision & Values',
                    'contact' => 'Contact',
                    'privacy' => 'Privacy Policy'
                ];
            @endphp
            <div class="flex flex-col space-y-3 text-xs uppercase tracking-widest font-medium">
                <span class="text-grey text-[10px] font-bold tracking-widest mb-2">{{ __('Navigation') }}</span>
                @foreach($dbPages as $dbPage)
                    @php
                        $key = $slugTitles[$dbPage->slug] ?? ucfirst(str_replace('-', ' ', $dbPage->slug));
                    @endphp
                    <a href="{{ $dbPage->slug === 'home' ? locale_route('home') : locale_route($dbPage->slug) }}" class="hover:text-grey transition-colors">
                        {{ __($key) }}
                    </a>
                @endforeach
            </div>

            <!-- Connect & Language Column -->
            <div class="flex flex-col space-y-6">
                <!-- Connect -->
                <div class="flex flex-col space-y-3 text-xs uppercase tracking-widest font-medium">
                    <span class="text-grey text-[10px] font-bold tracking-widest mb-2">{{ __('Connect') }}</span>
                    <a href="https://linkedin.com/company/yalabikogluandco" target="_blank" rel="noopener noreferrer" class="hover:text-grey transition-colors">LinkedIn</a>
                    <a href="https://medium.com/@efeyalabikoglu" target="_blank" rel="noopener noreferrer" class="hover:text-grey transition-colors">Medium</a>
                    <a href="https://instagram.com/yalabikogluco" target="_blank" rel="noopener noreferrer" class="hover:text-grey transition-colors">Instagram</a>
                </div>

                <!-- Language -->
                <div class="flex flex-col space-y-3 text-xs uppercase tracking-widest font-medium">
                    <span class="text-grey text-[10px] font-bold tracking-widest mb-1">{{ __('Language') }}</span>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 font-semibold uppercase tracking-wider">
                        @foreach(config('locales.supported', ['en' => 'English']) as $lang => $name)
                            <a href="{{ app(\App\Support\LocaleUrl::class)->for($lang) }}" 
                               class="transition-opacity {{ $currentLocale === $lang ? 'opacity-100' : 'opacity-40 hover:opacity-100' }}">
                                {{ __($name) }}
                            </a>
                            @if(!$loop->last)<span class="opacity-20">/</span>@endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto border-t border-hairline-invert mt-12 pt-6 flex flex-col md:flex-row justify-between items-center text-[10px] text-grey uppercase tracking-widest">
            <div>
                © {{ date('Y') }} Yalabikoglu & Co. {{ __('All rights reserved.') }}
            </div>
            <div class="mt-2 md:mt-0 flex space-x-6">
                <a href="https://linkedin.com/company/yalabikogluandco" target="_blank" rel="noopener noreferrer" class="hover:text-bone transition-colors">LinkedIn</a>
                <a href="{{ locale_route('privacy') }}" class="hover:text-bone transition-colors">{{ __('Privacy Policy') }}</a>
            </div>
        </div>
    </footer>

    <!-- Sticky Conversion Bar -->
    {{-- The bar exists to catch someone mid-page. Once the footer is on screen
         it has nothing left to offer — the same button is right above it — and
         being fixed it would sit on top of the copyright line. So it stands
         down as soon as the footer appears. --}}
    <div 
        x-data="{ scrolledEnough: false, footerVisible: false }"
        x-init="
            const footer = document.querySelector('footer');
            if (footer && 'IntersectionObserver' in window) {
                new IntersectionObserver(
                    ([entry]) => footerVisible = entry.isIntersecting
                ).observe(footer);
            }
        "
        @scroll.window="scrolledEnough = window.scrollY > (window.innerHeight * 0.85)"
        x-show="scrolledEnough && ! footerVisible"
        x-transition:enter="transition ease-out duration-500 transform"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-40 bg-ink text-bone border-t border-hairline-invert py-4 px-6 md:px-12 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-2xl"
        style="display: none;"
    >
        <div class="flex items-center space-x-4">
            <span class="w-2 h-2 bg-bone animate-pulse"></span>
            <span class="text-xs uppercase tracking-widest font-semibold leading-none">
                {{ __('Request Executive Briefing') }}
            </span>
        </div>
        <a 
            href="{{ briefing_url() }}" @if(briefing_url_is_external()) target="_blank" rel="noopener noreferrer" @endif
            class="bg-bone text-ink text-[10px] uppercase tracking-widest font-bold px-6 py-2.5 hover:bg-ink hover:text-bone border border-bone transition-all duration-300 text-center w-full sm:w-auto"
        >
            {{ __('Request Executive Briefing') }}
        </a>
    </div>

</body>
</html>
