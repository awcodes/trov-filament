<x-base-layout :meta="$meta">

    <div class="container py-8 lg:py-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => $page->title]" />

        <div class="flex items-center justify-between py-2 mt-2 mb-6 border-t border-b">
            @if ($page->tags)
                <p class="font-bold">Tagged: {{ $page->tags->implode('name', ', ') }}</p>
            @endif
            <p class="font-bold">Published: <time
                    datetime="{{ $page->published_at }}">{{ $page->published_at->diffForHumans() }}</time></p>
        </div>

        @if ($page->content)
            <x-block-content :content="$page->content" />
        @endif
    </div>
</x-base-layout>
