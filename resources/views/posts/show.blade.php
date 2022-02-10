<x-dynamic-component :component="$layout . '-layout'" :meta="$meta">
    @section('hero')
        <x-hero :image="$post->featured_image_data" />
    @endsection

    <x-blocks.heading :data="['level' => 'h1', 'content' => $post->title]" />

    <div class="flex items-center justify-between py-2 mt-2 mb-6 border-t border-b">
        @if ($post->tags)
            <p class="font-bold">Tagged: {{ $post->tags->implode('name', ', ') }}</p>
        @endif
        <p class="font-bold">Published: <time
                datetime="{{ $post->published_at }}">{{ $post->published_at->diffForHumans() }}</time></p>
    </div>

    @if ($post->content)
        @foreach ($post->content as $block)
            <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
        @endforeach
    @endif
</x-dynamic-component>