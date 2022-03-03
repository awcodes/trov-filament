<x-base-layout :meta="$meta">
    @section('hero')
        <x-hero :media="$article->featuredImage" />
    @endsection

    <div class="container pt-8 lg:pt-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => $article->title]" />

        <div class="flex items-center justify-between py-2 mt-2 border-t border-b">
            @if ($article->tags)
                <p class="font-bold">Tagged: {{ $article->tags->implode('name', ', ') }}</p>
            @endif
            <p class="font-bold">Published: <time
                    datetime="{{ $article->published_at }}">{{ $article->published_at->diffForHumans() }}</time></p>
        </div>
    </div>

    @if ($article->content)
        <x-block-content :content="$article->content" />
    @endif
</x-base-layout>
