<x-dynamic-component :component="$layout . '-layout'" :meta="$meta">

    @section('hero')
        <x-hero :media="$page->heroImage" :content="$page->hero_content" />
    @endsection

    <div class="container py-8 lg:py-12">
        @if ($page->content)
            @foreach ($page->content as $block)
                <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
            @endforeach
        @endif
    </div>
</x-dynamic-component>
