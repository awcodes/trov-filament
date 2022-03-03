<{{ $level }} @class([
    'text-4xl' => $level == 'h1',
    'text-3xl' => $level == 'h2',
    'text-2xl' => $level == 'h3',
    'text-xl' => $level == 'h4',
    'text-lg' => $level == 'h5',
    'text-lg' => $level == 'h6',
])>
    {{ $content }}
    </{{ $level }}>
