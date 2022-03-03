<div class="content">
    @foreach ($content as $container)
        <div @class([
            'container px-0 py-8 lg:py-12',
            'align-full' => $container['full_width'],
            'bg-primary-500' => $container['bg_color'] == 'primary',
            'bg-secondary-500' => $container['bg_color'] == 'secondary',
            'bg-tertiary-500' => $container['bg_color'] == 'tertiary',
            'bg-accent-500' => $container['bg_color'] == 'accent',
            'bg-gray-500' => $container['bg_color'] == 'gray',
        ])>
            @if ($container['blocks'])
                @foreach ($container['blocks'] as $block)
                    <x-dynamic-component :component="'blocks.' . $block['type']"
                        :data="$block['data']" />
                @endforeach
            @endif
        </div>
    @endforeach
</div>
