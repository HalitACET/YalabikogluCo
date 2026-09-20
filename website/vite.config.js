import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            /*
             * Fonts are downloaded at BUILD time and served from our own
             * origin. Nothing is fetched from Google Fonts, Bunny, or any
             * other CDN when a visitor loads a page — so no third party ever
             * sees a visitor's IP address. This is what makes the "no data
             * leaves this site" claim on the privacy page true.
             *
             * These two families are the ones declared in resources/css/app.css
             * (--font-heading and --font-sans). Keep the two in sync.
             */
            fonts: [
                bunny('Playfair Display', {
                    weights: [400, 500, 600, 700],
                    styles: ['normal', 'italic'],
                }),
                bunny('IBM Plex Sans', {
                    weights: [300, 400, 500, 600, 700],
                    styles: ['normal', 'italic'],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
