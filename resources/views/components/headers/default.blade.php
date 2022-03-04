<header id="site-header"
    class="py-6 bg-gray-800 wrapper">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('welcome') }}">
                <x-jet-application-logo class="h-8 text-primary-500" />
            </a>
        </div>
        <div>
            <nav aria-label="primary">
                <ul class="flex items-center gap-4">
                    <li>
                        <a href="{{ route('faqs.index') }}">FAQs</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
