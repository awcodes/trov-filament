<x-base-layout :meta="$meta">

    @section('hero')
        <x-hero :media="$page->heroImage"
            :content="$page->hero_content" />
    @endsection

    @if ($page->content)
        <x-block-content :content="$page->content" />
    @endif
</x-base-layout>
