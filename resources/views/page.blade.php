<x-base-layout :meta="$meta">

    @section('header')
        <x-headers.default />
    @endsection

    @section('hero')
        <x-hero :media="$page->heroImage"
            :content="$page->hero_content" />
    @endsection

    <x-grid>

        @if ($page->content)
            <x-block-content :content="$page->content" />
        @endif

        <x-slot name="sidebar">
            <x-widgets.discovery-center />
        </x-slot>
    </x-grid>

</x-base-layout>
