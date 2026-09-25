<?= '<?xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($pages as $urls)
@foreach($urls as $locale => $url)
    <url>
        <loc>{{ $url }}</loc>
@foreach($urls as $altLocale => $altUrl)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ $altUrl }}"/>
@endforeach
@isset($urls[$default])
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $urls[$default] }}"/>
@endisset
    </url>
@endforeach
@endforeach
</urlset>
