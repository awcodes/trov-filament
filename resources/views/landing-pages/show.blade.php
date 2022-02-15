<x-dynamic-component :component="$layout . '-layout'" :meta="$meta">
    @if ($page->content)
        @foreach ($page->content as $block)
            <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
        @endforeach
    @endif
</x-dynamic-component>
