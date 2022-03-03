<x-base-layout :meta="$meta">

    @section('header')
        <x-headers.default />
    @endsection

    @section('hero')
        <x-hero :media="$page->heroImage"
            :content="$page->hero_content" />
    @endsection

    <div class="container">
        @if ($page->content)
            <x-block-content :content="$page->content" />
        @endif
    </div>
</x-base-layout>
