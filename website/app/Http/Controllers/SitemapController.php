<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Response;

/**
 * sitemap.xml and robots.txt.
 *
 * Both are generated rather than kept as static files so they follow the
 * domain the site is actually served from. A file with a hardcoded host is
 * wrong the moment the domain changes, and a sitemap listing the wrong host is
 * ignored by search engines.
 *
 * Every page exists in four locales. Each entry therefore lists its siblings as
 * xhtml:link alternates, which is how Google is told these are translations of
 * one page rather than four pages of duplicate content.
 */
class SitemapController extends Controller
{
    public function sitemap(): Response
    {
        $locales = array_keys(config('locales.supported', []));
        $default = config('locales.default', 'en');

        // Route names, in the order they should appear.
        $routeNames = ['home', 'disciplines', 'axio-method', 'vision', 'case-studies', 'contact', 'privacy'];

        $pages = [];

        foreach ($routeNames as $name) {
            $pages[] = $this->localisedUrls($name, [], $locales, $default);
        }

        foreach (Discipline::query()->where('is_published', true)->orderBy('sort_order')->pluck('slug') as $slug) {
            $pages[] = $this->localisedUrls('disciplines.show', ['slug' => $slug], $locales, $default);
        }

        return response()
            ->view('sitemap', ['pages' => $pages, 'default' => $default])
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $body = implode("\n", [
            'User-agent: *',
            'Disallow: /admin',
            '',
            'Sitemap: '.url('/sitemap.xml'),
            '',
        ]);

        return response($body)->header('Content-Type', 'text/plain');
    }

    /**
     * Build every locale's URL for one route.
     *
     * @return array<string, string> locale => absolute URL
     */
    private function localisedUrls(string $name, array $parameters, array $locales, string $default): array
    {
        $urls = [];

        foreach ($locales as $locale) {
            $routeName = $locale === $default ? $name : "{$locale}.{$name}";

            if (app('router')->has($routeName)) {
                $urls[$locale] = route($routeName, $parameters);
            }
        }

        return $urls;
    }
}
