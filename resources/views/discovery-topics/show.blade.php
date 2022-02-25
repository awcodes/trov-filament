<x-dynamic-component :component="$layout . '-layout'"
    :meta="$meta">
    @section('hero')
        <x-hero :media="$topic->featuredImage" />
    @endsection

    <x-blocks.heading :data="['level' => 'h1', 'content' => $topic->title]" />

    <div class="flex items-center justify-between py-2 mt-2 mb-6 border-t border-b">
        @if ($topic->tags)
            <p class="font-bold">Tagged: {{ $topic->tags->implode('name', ', ') }}</p>
        @endif
        <p class="font-bold">Published: <time
                datetime="{{ $topic->published_at }}">{{ $topic->published_at->diffForHumans() }}</time></p>
    </div>

    @if ($topic->content)
        @foreach ($topic->content as $block)
            <x-dynamic-component :component="'blocks.' . $block['type']"
                :data="$block['data']" />
        @endforeach
    @endif
</x-dynamic-component>
