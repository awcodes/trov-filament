<x-dynamic-component :component="$layout . '-layout'" :meta="$meta">
    @section('hero')
        <x-hero :image="$page->hero_image" :content="$page->hero_content" />
    @endsection

    @if ($page->content)
        @foreach ($page->content as $block)
            <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
        @endforeach
    @endif
</x-dynamic-component>
