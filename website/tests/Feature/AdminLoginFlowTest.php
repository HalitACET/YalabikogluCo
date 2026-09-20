<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Auth\Pages\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Exercises the login form itself, rather than authenticating around it.
 *
 * AdminPanelTest uses actingAs(), which hands the panel an already-logged-in
 * user and never touches the login flow. That blind spot let a real regression
 * ship: the session middleware was removed from the 'web' group so public pages
 * would set no cookies, but Livewire registers POST /livewire/update in that
 * same group. Every Livewire request then ran without a session, so
 * Auth::login() had nowhere to persist and clicking "Sign in" did nothing at
 * all — no error, no redirect, no clue.
 *
 * These tests drive the actual Filament login component and assert on the
 * middleware Livewire depends on, so the same mistake fails here instead of in
 * someone's browser.
 */
class AdminLoginFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_log_in_through_the_filament_login_form(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.test',
            'password' => Hash::make('correct-horse-battery'),
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'admin@example.test',
                'password' => 'correct-horse-battery',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_the_wrong_password_is_rejected(): void
    {
        User::factory()->create([
            'email' => 'admin@example.test',
            'password' => Hash::make('correct-horse-battery'),
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'admin@example.test',
                'password' => 'not-the-password',
            ])
            ->call('authenticate')
            ->assertHasFormErrors();

        $this->assertGuest();
    }

    public function test_livewire_requests_still_get_a_session(): void
    {
        // Livewire posts component updates — including the login form — through
        // this route. Without StartSession on it, logging in cannot persist.
        $route = collect(Route::getRoutes()->getRoutes())
            ->first(fn ($route) => str_ends_with($route->uri(), 'livewire/update')
                || str_contains($route->uri(), '/update') && str_contains($route->uri(), 'livewire'));

        $this->assertNotNull($route, 'Could not find the Livewire update route.');

        $middleware = app('router')->gatherRouteMiddleware($route);

        $this->assertContains(
            \Illuminate\Session\Middleware\StartSession::class,
            $middleware,
            'The Livewire update route lost StartSession. Logging in will silently fail.'
        );
    }
}
