<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Guards the Filament admin panel.
 *
 * The public route group deliberately has no session, cookie, or CSRF
 * middleware (see bootstrap/app.php) so that public pages set no cookies.
 * The admin panel declares its own complete middleware stack in
 * AdminPanelProvider and must keep working regardless — these tests are what
 * catch it if that ever stops being true.
 */
class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_the_admin_panel(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_the_login_page_renders(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Sign in', false);
    }

    public function test_the_admin_panel_still_starts_a_session(): void
    {
        // The public site sets no cookies; the panel must still get one,
        // otherwise nobody could ever stay logged in.
        $response = $this->get('/admin/login');

        $this->assertNotEmpty(
            $response->headers->getCookies(),
            'The admin panel must still set a session cookie.'
        );
    }

    public function test_an_authenticated_user_can_open_the_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk();
    }

    public function test_an_authenticated_user_can_open_a_resource_listing(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin/disciplines')
            ->assertOk();
    }
}
