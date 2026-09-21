<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        /*
         * The public site is registered WITHOUT the 'web' middleware group.
         *
         * It has no forms, no login, and nothing to remember between requests,
         * so it needs no session — and a session would set the laravel-session
         * and XSRF-TOKEN cookies on every visitor, which the privacy page
         * promises does not happen.
         *
         * Note what this deliberately does NOT do: strip those middleware from
         * the 'web' group itself. Livewire registers POST /livewire/update in
         * the 'web' group, so removing StartSession from it leaves every
         * Livewire request without a session — which silently breaks the
         * Filament admin login, because Auth::login() has nowhere to persist.
         * Leave the group alone and opt the public routes out instead.
         *
         * If a public route ever needs a session or a POST form, give that one
         * route the 'web' group — and update the privacy page to match.
         */
        using: function () {
            Route::middleware([SubstituteBindings::class])
                ->group(base_path('routes/web.php'));

            // Passing `using` replaces the default route registration, which
            // is where the health endpoint would otherwise be defined.
            Route::get('/up', function () {
                return response('OK');
            })->name('health');
        },
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'set.locale' => \App\Http\Middleware\SetLocale::class,
        ]);

        // The host's load balancer terminates TLS and forwards plain HTTP with
        // X-Forwarded-Proto: https. Without trusting it, Laravel thinks every
        // request is HTTP and emits http:// asset URLs, which browsers block on
        // an https:// page — the site then renders as unstyled HTML. The app is
        // only reachable through that balancer, so trusting any proxy is safe.
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
