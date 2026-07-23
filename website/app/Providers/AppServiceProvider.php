<?php

namespace App\Providers;

use App\Support\LocaleUrl;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind LocaleUrl as a singleton so it is resolved only once per request.
        $this->app->singleton(LocaleUrl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // @hreflang — renders <link rel="alternate"> tags for every supported
        // locale plus x-default. Paste into your layout <head> section.
        Blade::directive('hreflang', function (): string {
            return "<?php echo app(\App\Support\LocaleUrl::class)->hreflangTags(); ?>";
        });
    }
}
