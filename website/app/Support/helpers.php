<?php

use App\Models\Page;
use App\Support\LocaleUrl;

if (! function_exists('page_meta')) {
    /**
     * Fetch the SEO translation row for a page slug in the current locale,
     * falling back to the default locale (see HasTranslations::translate).
     *
     * Returns null when the page has no row yet, so callers should use the
     * nullsafe operator:  page_meta('vision')?->meta_title
     */
    function page_meta(string $slug): ?\App\Models\PageTranslation
    {
        static $cache = [];

        if (! array_key_exists($slug, $cache)) {
            $cache[$slug] = Page::with('translations')->where('slug', $slug)->first();
        }

        return $cache[$slug]?->translate();
    }
}

if (! function_exists('locale_route')) {
    /**
     * Generate a URL for a public route in the CURRENT locale.
     *
     * Public routes are registered twice (see routes/web.php): once under their
     * base name for the default locale, and once per non-default locale with a
     * "{locale}." name prefix. This helper picks the right variant so that a
     * visitor browsing /ru/… keeps their locale when following internal links.
     *
     *   locale_route('disciplines')                        → /disciplines  or /ru/disciplines
     *   locale_route('disciplines.show', ['slug' => $slug]) → /ru/disciplines/self-mastery
     *
     * @param  array<string, mixed>  $parameters
     */
    function locale_route(string $name, array $parameters = []): string
    {
        $locale = app()->getLocale();
        $default = config('locales.default', 'en');

        $routeName = $locale === $default ? $name : "{$locale}.{$name}";

        if (app('router')->has($routeName)) {
            return route($routeName, $parameters);
        }

        // Fall back to the base (default-locale) route if only that variant exists.
        if (app('router')->has($name)) {
            return route($name, $parameters);
        }

        // Some pages referenced from the chrome are not registered yet
        // (e.g. contact, privacy). Build the locale-aware path by hand so the
        // link still points at the right place instead of throwing and taking
        // the whole page down with it.
        $path = $locale === $default ? "/{$name}" : "/{$locale}/{$name}";

        return url($path);
    }
}

if (! function_exists('localeUrl')) {
    /**
     * Access the LocaleUrl helper — the equivalent of the CURRENT page in
     * another locale. Used by the language switcher and the hreflang tags.
     */
    function localeUrl(): LocaleUrl
    {
        return app(LocaleUrl::class);
    }
}

if (! function_exists('briefing_url')) {
    /**
     * Where the "Request Executive Briefing" buttons point.
     *
     * The external scheduling page when one is configured, otherwise the
     * contact page. Callers should treat an http(s) result as external and
     * open it in a new tab with rel="noopener".
     */
    function briefing_url(): string
    {
        return config('contact.booking_url') ?: locale_route('contact');
    }
}

if (! function_exists('briefing_url_is_external')) {
    function briefing_url_is_external(): bool
    {
        $url = config('contact.booking_url');

        return is_string($url) && str_starts_with($url, 'http');
    }
}
