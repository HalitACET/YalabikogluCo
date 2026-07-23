<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * Detects the active locale from the first URL segment.
     * - English (default) routes have NO prefix → segment 1 won't be a locale code.
     * - Other locales (lv, fr, ru) ARE the first URL segment.
     *
     * Because we only register routes with known locale prefixes, invalid
     * prefixes like /xx/ never reach this middleware (they 404 at routing).
     * We keep the abort(404) as a belt-and-suspenders safeguard.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var array<string, string> $supported  e.g. ['en' => 'English', 'lv' => 'Latviešu'] */
        $supported = config('locales.supported', ['en' => 'English']);
        $default   = config('locales.default', 'en');

        // The first URL segment is either a locale code (lv/fr/ru) or a route
        // slug (disciplines, contact …). Only accept it as a locale if it is
        // explicitly in our supported list AND is not the default (EN has no prefix).
        $segment = $request->segment(1);

        $locale = ($segment && array_key_exists($segment, $supported) && $segment !== $default)
            ? $segment
            : $default;

        // Belt-and-suspenders: should never fire due to route registration,
        // but guards against middleware being mis-applied to unknown locales.
        if (! array_key_exists($locale, $supported)) {
            abort(404);
        }

        // Apply locale to the application for this request.
        app()->setLocale($locale);

        // Share data with every view so Blade templates can render the
        // language switcher and hreflang tags without extra view composers.
        view()->share('currentLocale', $locale);
        view()->share('supportedLocales', $supported);

        return $next($request);
    }
}
