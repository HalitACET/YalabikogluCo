<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

/**
 * LocaleUrl — locale-aware URL generation helper.
 *
 * Generates the equivalent URL of the CURRENT page in any supported locale.
 * Works by stripping any existing locale prefix from the active route name,
 * then re-applying the target locale prefix.
 *
 * Route naming convention this relies on:
 *   - English (default):  route name = "home", "disciplines.show", etc.
 *   - Other locales:      route name = "lv.home", "fr.disciplines.show", etc.
 *
 * This means localeUrl->for('fr') on /lv/disciplines/executive-presence
 * correctly produces /fr/disciplines/executive-presence.
 *
 * Usage in Blade:
 *   {{ localeUrl()->for('fr') }}
 *   {!! localeUrl()->hreflangTags() !!}
 *   @hreflang                          (Blade directive — same as above)
 *
 * Usage in PHP:
 *   app(LocaleUrl::class)->for('lv')
 *   app(LocaleUrl::class)->all()
 */
class LocaleUrl
{
    // ------------------------------------------------------------------ //
    //  Public API
    // ------------------------------------------------------------------ //

    /**
     * Generate the equivalent URL of the current page in $targetLocale.
     *
     * @param  string  $targetLocale  ISO 639-1 code, e.g. 'en', 'lv', 'fr', 'ru'
     */
    public function for(string $targetLocale): string
    {
        $default    = config('locales.default', 'en');
        $routeName  = $this->baseRouteName();
        $routeParams = $this->baseRouteParams();

        if ($targetLocale === $default) {
            return route($routeName, $routeParams);
        }

        return route("{$targetLocale}.{$routeName}", $routeParams);
    }

    /**
     * Return an associative array of locale => URL for all supported locales.
     *
     * Useful for building the language switcher in the navigation.
     *
     * @return array<string, string>  e.g. ['en' => 'https://…', 'lv' => 'https://…/lv/…']
     */
    public function all(): array
    {
        $result = [];

        foreach (array_keys(config('locales.supported', [])) as $locale) {
            try {
                $result[$locale] = $this->for($locale);
            } catch (\Throwable) {
                // If a route variant is not yet defined for this locale,
                // fall back to the locale root URL so the switcher still renders.
                $result[$locale] = $this->localeRootUrl($locale);
            }
        }

        return $result;
    }

    /**
     * Render <link rel="alternate"> hreflang tags for every supported locale,
     * plus an x-default pointing at the English (default) version.
     *
     * Output is intentionally NOT escaped — it contains safe, server-generated HTML.
     * Wrap with {!! !!} or use @hreflang in Blade.
     */
    public function hreflangTags(): HtmlString
    {
        $supported = config('locales.supported', []);
        $default   = config('locales.default', 'en');
        $tags      = [];

        foreach (array_keys($supported) as $locale) {
            try {
                $url = $this->for($locale);
                $tags[] = sprintf(
                    '    <link rel="alternate" hreflang="%s" href="%s">',
                    e($locale),
                    e($url)
                );
            } catch (\Throwable) {
                // Skip locales whose route variant is not yet registered.
            }
        }

        // x-default always points at the canonical (English, no-prefix) URL.
        try {
            $tags[] = sprintf(
                '    <link rel="alternate" hreflang="x-default" href="%s">',
                e($this->for($default))
            );
        } catch (\Throwable) {
            // skip
        }

        return new HtmlString(implode("\n", $tags));
    }

    // ------------------------------------------------------------------ //
    //  Private helpers
    // ------------------------------------------------------------------ //

    /**
     * Get the base route name, stripped of any leading locale prefix.
     *
     * e.g. "lv.disciplines.show" → "disciplines.show"
     *      "home"               → "home"
     */
    private function baseRouteName(): string
    {
        $routeName = request()->route()?->getName() ?? 'home';
        $default   = config('locales.default', 'en');

        foreach (array_keys(config('locales.supported', [])) as $locale) {
            if ($locale !== $default && str_starts_with($routeName, "{$locale}.")) {
                return substr($routeName, strlen($locale) + 1);
            }
        }

        return $routeName;
    }

    /**
     * Get the current route parameters, excluding the implicit locale segment.
     *
     * The locale is a URL prefix, not a named route parameter, so route()->parameters()
     * never contains it. We still explicitly unset 'locale' as a safeguard.
     *
     * @return array<string, mixed>
     */
    private function baseRouteParams(): array
    {
        $params = request()->route()?->parameters() ?? [];
        unset($params['locale']); // safety guard — should never be present

        return $params;
    }

    /**
     * Fallback root URL for a given locale (used when a route is not yet defined).
     */
    private function localeRootUrl(string $locale): string
    {
        $default = config('locales.default', 'en');

        return $locale === $default
            ? url('/')
            : url('/' . $locale);
    }
}
