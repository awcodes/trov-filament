@props([
    'media' => [],
    'content' => null,
])

<aside class="relative flex items-center justify-center h-96">
    @if ($media || $content)
        <img src="{{ $media->url }}"
            alt="{{ $media->alt }}"
            width="{{ $media->width }}"
            height="{{ $media->height }}"
            srcset="
            {{ $media->url }} 1200w,
            {{ $media->large }} 1024w,
            {{ $media->medium }} 640w
        "
            sizes="(max-width: 1200px) 100vw, 1200px"
            loading="lazy"
            class="absolute inset-0 z-0 object-cover w-full h-full" />
        <p class="container z-10 text-4xl font-bold text-white text-shadow-md">{{ $content }}</p>
    @else
        {{ $slot }}
    @endif
</aside>
