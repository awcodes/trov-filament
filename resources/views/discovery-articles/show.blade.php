<x-dynamic-component :component="$layout . '-layout'"
    :meta="$meta">
    @section('hero')
        <x-hero :media="$article->featuredImage" />
    @endsection

    <div class="container py-8 lg:py-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => $article->title]" />

        <div class="flex items-center justify-between py-2 mt-2 mb-6 border-t border-b">
            @if ($article->tags)
                <p class="font-bold">Tagged: {{ $article->tags->implode('name', ', ') }}</p>
            @endif
            <p class="font-bold">Published: <time
                    datetime="{{ $article->published_at }}">{{ $article->published_at->diffForHumans() }}</time></p>
        </div>

        @if ($article->content)
            <x-block-content :blocks="$article->content" />
        @endif
    </div>
</x-dynamic-component>
