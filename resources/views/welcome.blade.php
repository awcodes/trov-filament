<x-dynamic-component :component="$layout . '-layout'"
    :meta="$meta">

    @section('hero')
        <x-hero>
            <div
                class="absolute inset-0 flex items-center justify-center bg-gradient-to-tl from-black via-gray-900 to-black">
                <x-jet-application-logo class="h-16 text-yellow-500" />
            </div>
        </x-hero>
    @endsection

    <div class="container py-8 lg:py-12">
        <div class="prose max-w-none dark:prose-invert">
            <h1>{{ $meta['title'] }}</h1>
            <p>Minima tempora in debitis. Deleniti similique sit et blanditiis qui fuga. Totam dolorum laudantium
                pariatur.</p>

            <p>Cumque sit et sit non earum ut. Est perspiciatis cupiditate et exercitationem nihil harum esse vero.
                Voluptas rem repellendus sed voluptas ea sint.</p>

            <p>Assumenda placeat dignissimos atque et. Facere natus soluta error optio quidem et. Rerum voluptatem esse
                porro pariatur. Ea sunt ea voluptates blanditiis.</p>

            <p>Maiores est molestiae voluptate recusandae est. Modi corrupti in quod sunt sit porro nihil aut. Et cum ex
                sed ut.</p>

            <h2>Heading 2</h2>
            <p>Cumque sit et sit non earum ut. Est perspiciatis cupiditate et exercitationem nihil harum esse vero.
                Voluptas rem repellendus sed voluptas ea sint.</p>

            <p>Assumenda placeat dignissimos atque et. Facere natus soluta error optio quidem et. Rerum voluptatem esse
                porro pariatur. Ea sunt ea voluptates blanditiis.</p>

            <p>Maiores est molestiae voluptate recusandae est. Modi corrupti in quod sunt sit porro nihil aut. Et cum ex
                sed ut.</p>
        </div>
    </div>

    <div x-data="{
        mode: null,
        theme: null,
        init: function () {
            this.theme = localStorage.getItem('theme') || (this.isSystemDark() ? 'dark' : 'light')
            this.mode = localStorage.getItem('theme') ? 'manual' : 'auto'

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
                if (this.mode === 'manual') return

                if (event.matches && (! document.documentElement.classList.contains('dark'))) {
                    this.theme = 'dark'

                    document.documentElement.classList.add('dark')
                } else if ((! event.matches) && document.documentElement.classList.contains('dark')) {
                    this.theme = 'light'

                    document.documentElement.classList.remove('dark')
                }
            })

            $watch('theme', () => {
                if (this.mode === 'auto') return

                localStorage.setItem('theme', this.theme)

                if (this.theme === 'dark' && (! document.documentElement.classList.contains('dark'))) {
                    document.documentElement.classList.add('dark')
                } else if (this.theme === 'light' && document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark')
                }

                $dispatch('dark-mode-toggled', this.theme)
            })
        },

        isSystemDark: function () {
            return window.matchMedia('(prefers-color-scheme: dark)').matches
        },
    }"
        class="fixed top-0 right-2">
        <div class="absolute right-0 z-10 mt-2 shadow-xl rtl:right-auto rtl:left-0 rounded-xl w-52 top-full">
            <ul @class([
                'py-1 space-y-1 overflow-hidden bg-white shadow rounded-xl',
                'dark:border-gray-600 dark:bg-gray-700' => config('filament.dark_mode'),
            ])>
                <div>
                    @if (config('filament.dark_mode'))
                        <x-filament::dropdown.item icon="heroicon-s-moon"
                            x-show="theme === 'dark'"
                            x-on:click="mode = 'manual'; theme = 'light'">
                            {{ __('filament::layout.buttons.light_mode.label') }}
                        </x-filament::dropdown.item>

                        <x-filament::dropdown.item icon="heroicon-s-sun"
                            x-show="theme === 'light'"
                            x-on:click="mode = 'manual'; theme = 'dark'">
                            {{ __('filament::layout.buttons.dark_mode.label') }}
                        </x-filament::dropdown.item>
                    @endif
                </div>
            </ul>
        </div>
    </div>
</x-dynamic-component>
