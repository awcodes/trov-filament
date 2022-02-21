<?xml version="1.0" encoding="UTF-8"?>
{{-- <?xml-stylesheet type="text/xsl" href="{{ asset('css/sitemap.xsl') }}"?> --}}

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @if ($links)
        @foreach ($links as $link)
            <sitemap>
                <loc>
                    <![CDATA[{{ $link->getPublicUrl() }}]]>
                </loc>
                <lastmod>
                    <![CDATA[{{ $link->updated_at->tz('UTC')->toAtomString() }}]]>
                </lastmod>
            </sitemap>
        @endforeach
    @endif
</sitemapindex>
