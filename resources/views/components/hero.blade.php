@props([
    'image' => null,
    'content' => null,
])

@if ($image || $content)
    <aside class="relative flex items-center justify-center h-96">
        <img src="{{ Storage::disk('images')->url($image) }}" alt=""
            class="absolute inset-0 z-0 object-cover w-full h-full" />
        <p class="z-10">{{ $content }}</p>
    </aside>
@endif
