@props([
    'data' => [
        'url' => null,
        'alt' => '',
        'width' => '',
        'height' => '',
        'content' => null,
    ],
    'width' => '1024px',
    'height' => '564px',
])

@if ($data['url'] || $data['content'])
    <aside class="relative flex items-center justify-center h-96">
        <img src="{{ Storage::disk('images')->url($data['url']) }}" alt="{{ $data['alt'] }}"
            width="{{ isset($data['width']) ?: $width }}" height="{{ isset($data['height']) ?: $height }}"
            class="absolute inset-0 z-0 object-cover w-full h-full" />
        <p class="z-10">{{ $data['content'] }}</p>
    </aside>
@endif
