<x-dynamic-component :component="$layout . '-layout'" :meta="$meta">
    @section('hero')
        <x-hero :image="$article->featured_image_data" />
    @endsection

    <x-blocks.heading :data="['level' => 'h1', 'content' => $article->title]" />

    <div class="flex items-center justify-between py-2 mt-2 mb-6 border-t border-b">
        @if ($article->tags)
            <p class="font-bold">Tagged: {{ $article->tags->implode('name', ', ') }}</p>
        @endif
        <p class="font-bold">Published: <time
                datetime="{{ $article->published_at }}">{{ $article->published_at->diffForHumans() }}</time></p>
    </div>

    @if ($article->content)
        @foreach ($article->content as $block)
            <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
        @endforeach
    @endif
</x-dynamic-component>
