<{{ $level }} @class([
    'text-4xl' => $level == 'h1',
    'text-3xl mt-8' => $level == 'h2',
    'text-2xl mt-8' => $level == 'h3',
    'text-xl mt-8' => $level == 'h4',
    'text-lg mt-8' => $level == 'h5',
    'text-lg mt-8' => $level == 'h6',
])>
    {{ $content }}
    </{{ $level }}>
