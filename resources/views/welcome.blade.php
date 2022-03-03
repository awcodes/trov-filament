<x-dynamic-component :component="$layout . '-layout'"
    :meta="$meta">

    @section('hero')
        <x-hero :media="$page->heroImage"
            :content="$page->hero_content" />
    @endsection

    <div class="container py-8 lg:py-12">
        @if ($page->content)
            <x-block-content :blocks="$page->content" />
        @endif
    </div>
</x-dynamic-component>
