<?php

namespace Tests\Feature;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Tests\TestCase;

/**
 * A UTF-8 BOM at the start of a PHP file is emitted before any response body,
 * because PHP treats those three bytes as output.
 *
 * config/locales.php had one. It prefixed every HTML page, and every JavaScript
 * response served through a PHP route, with \xEF\xBB\xBF. Browsers then failed
 * to parse livewire.js with "SyntaxError: Invalid or unexpected token", Livewire
 * never booted, and the admin login form silently did nothing when clicked.
 *
 * Nothing about that failure points at a BOM, and the file looks normal in every
 * editor, so it cost a long time to find. This test makes it a one-line failure
 * instead.
 */
class NoByteOrderMarkTest extends TestCase
{
    private const BOM = "\xEF\xBB\xBF";

    /** Directories that are not ours to police. */
    private const SKIP = ['vendor', 'node_modules', 'storage', 'public', '.git'];

    public function test_no_php_file_starts_with_a_byte_order_mark(): void
    {
        $offenders = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(base_path(), FilesystemIterator::SKIP_DOTS)
        );

        /** @var SplFileInfo $file */
        foreach ($iterator as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $relative = str_replace('\\', '/', substr($file->getPathname(), strlen(base_path()) + 1));

            foreach (self::SKIP as $skip) {
                if (str_starts_with($relative, $skip.'/')) {
                    continue 2;
                }
            }

            $handle = fopen($file->getPathname(), 'rb');
            $first = fread($handle, 3);
            fclose($handle);

            if ($first === self::BOM) {
                $offenders[] = $relative;
            }
        }

        $this->assertSame(
            [],
            $offenders,
            "These PHP files start with a UTF-8 BOM, which PHP emits ahead of every ".
            "response body and which corrupts JavaScript served through PHP routes:\n  ".
            implode("\n  ", $offenders)."\n".
            'Re-save them as UTF-8 without BOM.'
        );
    }
}
