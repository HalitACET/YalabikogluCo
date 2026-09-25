<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The sitemap is how a new site gets found. Without it, search engines have to
 * discover pages by following links from somewhere that already ranks, which
 * for a site with no inbound links means waiting.
 */
class SitemapTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_the_sitemap_is_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $this->assertStringContainsString('application/xml', $response->headers->get('Content-Type'));

        $previous = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response->getContent());
        libxml_use_internal_errors($previous);

        $this->assertNotFalse($xml, 'The sitemap is not parseable XML.');
    }

    public function test_the_sitemap_lists_every_page_in_every_locale(): void
    {
        $body = $this->get('/sitemap.xml')->getContent();

        // 7 static pages + 4 disciplines, each in 4 locales.
        $this->assertSame(
            44,
            substr_count($body, '<loc>'),
            'Expected 11 pages across 4 locales.'
        );

        foreach (['/lv/vision', '/fr/case-studies', '/ru/contact', '/disciplines/self-mastery'] as $path) {
            $this->assertStringContainsString($path.'<', $body, "Missing from sitemap: {$path}");
        }
    }

    public function test_each_entry_declares_its_translations(): void
    {
        $body = $this->get('/sitemap.xml')->getContent();

        foreach (['en', 'lv', 'fr', 'ru', 'x-default'] as $hreflang) {
            $this->assertStringContainsString(
                'hreflang="'.$hreflang.'"',
                $body,
                "The sitemap does not declare {$hreflang} alternates."
            );
        }
    }

    public function test_robots_points_at_the_sitemap_and_hides_the_admin_panel(): void
    {
        $body = $this->get('/robots.txt')->assertOk()->getContent();

        $this->assertStringContainsString('Sitemap: '.url('/sitemap.xml'), $body);
        $this->assertStringContainsString('Disallow: /admin', $body);
    }

    public function test_pages_declare_a_canonical_url(): void
    {
        foreach (['/', '/vision', '/ru/case-studies'] as $path) {
            $html = $this->get($path)->getContent();

            $this->assertStringContainsString(
                '<link rel="canonical"',
                $html,
                "{$path} has no canonical tag."
            );
        }
    }
}
