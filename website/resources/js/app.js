/*
 * Alpine is bundled into this file rather than pulled from a CDN.
 *
 * A <script src="https://cdn.jsdelivr.net/..."> tag would send every visitor's
 * IP address and user agent to a third party on every page load. Bundling it
 * keeps all traffic on our own origin, which is what the privacy page promises.
 * Do not reintroduce a CDN script tag.
 */
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/*
 * Scroll reveal. Elements marked .reveal-on-scroll start faded out (see
 * app.css) and fade in once they enter the viewport.
 *
 * Lives here rather than in an inline <script> in the layout so the page needs
 * no inline JavaScript and can be served under a strict Content-Security-Policy
 * if one is ever added.
 */
const initScrollReveal = () => {
    const targets = document.querySelectorAll('.reveal-on-scroll');

    // Without IntersectionObserver, show everything rather than hiding content.
    if (! ('IntersectionObserver' in window)) {
        targets.forEach((el) => el.classList.add('reveal-visible'));

        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.05,
            rootMargin: '0px 0px -50px 0px',
        }
    );

    targets.forEach((el) => observer.observe(el));
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollReveal);
} else {
    initScrollReveal();
}
