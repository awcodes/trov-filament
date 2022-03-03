<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <meta name="description"
        content="{{ $description }}">
    <meta name="robots"
        content="{{ $robots }}">

    @yield('meta')

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet"
        href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"
        defer></script>

    <script>
        const theme = localStorage.getItem('theme')

        if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        }
    </script>
    @livewireStyles
</head>

<body class="font-sans antialiased text-gray-900 dark:text-gray-50 dark:bg-gray-900">

    @yield('header')

    <main id="site-main">

        @yield('hero')

        {{ $slot }}

    </main>

    <footer>

    </footer>

    @livewireScripts

    @stack('additional')

</body>

</html>
