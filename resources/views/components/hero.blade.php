@props([
    'media' => [],
    'content' => null,
])

@if ($media || $content)
    <aside class="relative flex items-center justify-center h-96">
        <img src="{{ $media[0]->getFullUrl() }}" alt="{{ $media[0]->getCustomProperty('alt') }}"
            class="absolute inset-0 z-0 object-cover w-full h-full" />
        <p class="z-10">{{ $content }}</p>
    </aside>
@endif
