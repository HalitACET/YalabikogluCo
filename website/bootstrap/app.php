<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'set.locale' => \App\Http\Middleware\SetLocale::class,
        ]);

        /*
         * The public site is stateless by design.
         *
         * It has no forms, no login, and nothing to remember between requests,
         * so it does not need a session — and a session would mean setting the
         * laravel-session and XSRF-TOKEN cookies on every visitor. Stripping
         * these from the 'web' group means the public pages set NO cookies at
         * all, which is what the privacy page promises.
         *
         * The Filament admin panel is unaffected: it declares its own complete
         * middleware stack (including StartSession, EncryptCookies and
         * PreventRequestForgery) in AdminPanelProvider, so /admin keeps working.
         *
         * If a public route ever needs a session or a POST form, re-add these
         * for that route only — and update the privacy page to match.
         */
        $middleware->web(remove: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestForgery::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
