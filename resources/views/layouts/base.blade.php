<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1" />
    <meta name="csrf-token"
        content="{{ csrf_token() }}" />

    <title>{{ $title }}</title>
    <meta name="description"
        content="{{ $description }}" />
    <meta name="robots"
        content="{{ $robots }}" />

    @yield('meta')

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" />

    <!-- Styles -->
    <link rel="stylesheet"
        href="{{ mix('css/app.css') }}" />

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"
        defer></script>

    @if (config('site.gtm_active'))
        <style>
            .async-hide {
                opacity: 0 !important
            }

        </style>
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start": new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "{{ config('site.gtm_id') }}");
        </script>
    @endif

    @livewireStyles
</head>

<body class="h-full font-sans text-gray-900 bg-gray-100">

    @if (config('site.gtm_active'))
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id={{ config('site.gtm_id') }}"
                height="0"
                width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <div class="flex flex-col h-full">
        @yield('header')

        <main id="site-main"
            class="flex-1">

            @yield('hero')

            {{ $slot }}

        </main>

        @yield('footer')
    </div>

    @livewireScripts

    @stack('additional')

</body>

</html>
