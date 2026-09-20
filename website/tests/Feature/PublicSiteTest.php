<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Locks in the behaviour the privacy page promises.
 *
 * The public site claims, in four languages, that it sets no cookies, runs no
 * third-party requests, and has no forms. These tests are what make that claim
 * something the codebase enforces rather than something we merely remember.
 *
 * If one of these fails, either fix the page or rewrite /privacy — do not
 * delete the test.
 */
class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    /** Locale prefixes: '' is the default (English) locale, which has no prefix. */
    private const LOCALES = ['', '/lv', '/fr', '/ru'];

    private const PATHS = [
        '/',
        '/disciplines',
        '/disciplines/executive-presence',
        '/disciplines/executive-positioning',
        '/disciplines/self-mastery',
        '/disciplines/strategic-messaging',
        '/axio-method',
        '/vision',
        '/case-studies',
        '/contact',
        '/privacy',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /** @return array<string> every public URL, in every locale */
    private function urls(): array
    {
        $urls = [];

        foreach (self::LOCALES as $locale) {
            foreach (self::PATHS as $path) {
                // '' . '/' is '/', and '/lv' . '/' would be '/lv/' — both resolve.
                $urls[] = $locale === '' ? $path : rtrim($locale.$path, '/');
            }
        }

        return $urls;
    }

    public function test_every_public_page_responds_successfully(): void
    {
        foreach ($this->urls() as $url) {
            $this->get($url)->assertOk("{$url} did not return 200");
        }
    }

    public function test_no_public_page_sets_a_cookie(): void
    {
        foreach ($this->urls() as $url) {
            $cookies = $this->get($url)->headers->getCookies();

            $names = array_map(fn ($cookie) => $cookie->getName(), $cookies);

            $this->assertSame(
                [],
                $names,
                "{$url} set cookie(s): ".implode(', ', $names).
                ' — the privacy page promises none are set.'
            );
        }
    }

    public function test_no_public_page_loads_assets_from_a_third_party(): void
    {
        // Outbound links to social profiles are fine: the visitor chooses to
        // follow them. What must not appear is a src/href that the BROWSER
        // fetches automatically — fonts, scripts, images, stylesheets.
        $ownHost = parse_url(config('app.url'), PHP_URL_HOST);

        // Outbound destinations the visitor chooses to follow. The scheduling
        // link belongs here for the same reason the social links do: it is a
        // link, not an embed, so nothing is fetched from it on page load. If it
        // ever becomes an embedded widget, this test should start failing.
        $bookingHost = parse_url((string) config('contact.booking_url'), PHP_URL_HOST);

        $allowedHosts = array_filter([
            $ownHost, $bookingHost, 'linkedin.com', 'medium.com', 'instagram.com',
        ]);

        foreach ($this->urls() as $url) {
            $html = $this->get($url)->getContent();

            preg_match_all('/(?:src|href)="(https?:\/\/[^"]+)"/i', $html, $matches);

            foreach ($matches[1] as $assetUrl) {
                $host = parse_url($assetUrl, PHP_URL_HOST);

                $this->assertContains(
                    $host,
                    $allowedHosts,
                    "{$url} references {$host} — the privacy page promises no third-party requests."
                );
            }
        }
    }

    public function test_no_public_page_contains_a_form(): void
    {
        foreach ($this->urls() as $url) {
            $html = $this->get($url)->getContent();

            $this->assertStringNotContainsString('<form', $html, "{$url} contains a form.");
            $this->assertStringNotContainsString('<input', $html, "{$url} contains an input.");
        }
    }

    public function test_pages_are_translated_rather_than_falling_back_to_english(): void
    {
        $expectations = [
            '/lv/vision' => 'Vīzija un vērtības',
            '/fr/vision' => 'Vision et valeurs',
            '/ru/vision' => 'Видение и ценности',
            '/lv/disciplines/self-mastery' => 'Vadītāja pašpārvalde',
            '/fr/disciplines/self-mastery' => 'Maîtrise de soi exécutive',
            '/ru/disciplines/self-mastery' => 'Лидерское самообладание',
        ];

        foreach ($expectations as $url => $needle) {
            $this->get($url)->assertSee($needle, false);
        }
    }

    public function test_no_table_exists_for_storing_visitor_personal_data(): void
    {
        // The site is built so that visitor data is never received in the
        // first place. Schema that could hold it was removed rather than
        // merely left unused, so there is nothing to leak, export or erase.
        $this->assertFalse(
            Schema::hasTable('contact_submissions'),
            'contact_submissions is back. The site is not meant to store visitor data at all.'
        );

        foreach (['name', 'email', 'ip_hash', 'consent_at'] as $column) {
            $this->assertFalse(
                Schema::hasColumn('pages', $column),
                "A visitor data column ({$column}) appeared on a content table."
            );
        }
    }

    public function test_the_language_switcher_keeps_the_visitor_on_the_same_page(): void
    {
        // Internal links must carry the locale prefix, otherwise a visitor
        // browsing in Russian is silently dropped back into English.
        $html = $this->get('/ru/vision')->getContent();

        $this->assertStringContainsString('/ru/disciplines', $html);
        $this->assertStringContainsString('/ru/case-studies', $html);
        $this->assertStringContainsString('/ru/contact', $html);
    }
}
