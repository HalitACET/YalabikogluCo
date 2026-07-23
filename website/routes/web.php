<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Public Route Groups — Locale-Aware
|--------------------------------------------------------------------------
|
| All public routes are defined ONCE in $publicRoutes and then registered
| in two groups:
|
|   1. English (default) — no URL prefix, base route names.
|      e.g. route('home') → /
|           route('disciplines.show', ['slug' => 'executive-presence']) → /disciplines/executive-presence
|
|   2. Non-English — URL prefix + route-name prefix per locale.
|      e.g. route('lv.home') → /lv/
|           route('fr.disciplines.show', ['slug' => 'executive-presence']) → /fr/disciplines/executive-presence
|
| Route-model-binding safety:
|   The locale is a STATIC URL prefix (e.g. /lv/), NOT a {locale} route
|   parameter. Therefore {slug} and other parameters never conflict with the
|   locale segment.
|
| Invalid locale prefixes (e.g. /xx/):
|   Are never registered → Laravel returns 404 automatically. No extra logic
|   needed in middleware.
|
| URL generation for the language switcher / hreflang:
|   Use app(\App\Support\LocaleUrl::class)->for('fr')
|   or the @hreflang Blade directive for <head> tags.
|
*/

// ---------------------------------------------------------------------------
// Shared public route definitions (Phase 3 will add all public pages here)
// ---------------------------------------------------------------------------
$publicRoutes = static function (): void {
    Route::get('/', static fn () => view('welcome'))->name('home');

    // Disciplines Pages
    Route::get('disciplines', [DisciplineController::class, 'index'])->name('disciplines');
    Route::get('disciplines/{slug}', [DisciplineController::class, 'show'])->name('disciplines.show');

    // AXIO, Vision, Case Studies
    Route::get('axio-method', [PageController::class, 'axioMethod'])->name('axio-method');
    Route::get('vision', [PageController::class, 'vision'])->name('vision');
    Route::get('case-studies', [PageController::class, 'caseStudies'])->name('case-studies');
};

// ---------------------------------------------------------------------------
// Group 1: English — no prefix, base route names (e.g. 'home')
// ---------------------------------------------------------------------------
Route::middleware('set.locale')
    ->group($publicRoutes);

// ---------------------------------------------------------------------------
// Group 2: Non-English locales — URL prefix + name prefix per locale
//   lv → /lv/…  with route names like 'lv.home', 'lv.disciplines.show'
//   fr → /fr/…  with route names like 'fr.home', 'fr.disciplines.show'
//   ru → /ru/…  with route names like 'ru.home', 'ru.disciplines.show'
// ---------------------------------------------------------------------------
$nonDefaultLocales = array_keys(
    array_filter(
        config('locales.supported', []),
        static fn ($_, $locale) => $locale !== config('locales.default', 'en'),
        ARRAY_FILTER_USE_BOTH
    )
);

foreach ($nonDefaultLocales as $locale) {
    Route::middleware('set.locale')
        ->prefix($locale)
        ->name("{$locale}.")
        ->group($publicRoutes);
}
