@props([
    'image' => [
        'url' => null,
        'alt' => '',
        'width' => 'auto',
        'height' => 'auto',
    ],
    'content' => null,
])

@if ($image['url'] || $content)
    <aside class="relative flex items-center justify-center h-96">
        <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" width="{{ $image['width'] }}"
            height="{{ $image['height'] }}" class="absolute inset-0 z-0 object-cover w-full h-full" />
        <p class="z-10">{{ $content }}</p>
    </aside>
@endif
