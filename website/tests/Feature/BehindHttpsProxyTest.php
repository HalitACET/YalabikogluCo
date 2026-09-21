<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * In production the app sits behind the host's load balancer, which
 * terminates TLS and forwards plain HTTP with X-Forwarded-Proto: https.
 *
 * If Laravel does not trust that header it believes the request is HTTP and
 * emits http:// URLs for the compiled CSS and JS. The browser, on an https://
 * page, blocks those as mixed content: the site renders as unstyled HTML while
 * images — which browsers still allow — load fine. That is exactly what the
 * first Render deploy looked like.
 */
class BehindHttpsProxyTest extends TestCase
{
    use RefreshDatabase;

    public function test_asset_urls_use_https_when_the_proxy_says_the_request_was_https(): void
    {
        $this->seed(DatabaseSeeder::class);

        $html = $this->withHeaders([
            'X-Forwarded-Proto' => 'https',
            'X-Forwarded-Host' => 'yalabikoglu.onrender.com',
            'X-Forwarded-Port' => '443',
        ])->get('/')->getContent();

        preg_match_all('/(?:href|src)="(https?:\/\/[^"]*\/build\/assets\/[^"]+)"/', $html, $matches);

        $this->assertNotEmpty($matches[1], 'No compiled asset URLs found on the page.');

        foreach ($matches[1] as $url) {
            $this->assertStringStartsWith(
                'https://',
                $url,
                "Asset served over plain HTTP behind an HTTPS proxy — browsers block it as mixed content: {$url}"
            );
        }
    }
}
