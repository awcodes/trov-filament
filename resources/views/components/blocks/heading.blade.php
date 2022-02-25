@props([
    'data' => [
        'content' => '',
        'level' => '',
    ],
    'classes' => [
        'h1' => 'text-4xl',
        'h2' => 'text-3xl mt-8',
        'h3' => 'text-2xl mt-8',
        'h4' => 'text-xl mt-8',
        'h5' => 'text-lg mt-8',
        'h6' => 'text-lg mt-8',
    ],
])

<{{ $data['level'] }} class="{{ $classes[$data['level']] }}">
    {{ $data['content'] }}
    </{{ $data['level'] }}>
