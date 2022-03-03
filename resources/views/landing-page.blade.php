<x-base-layout :meta="$meta">
    <div class="container">
        @if ($page->content)
            <x-block-content :content="$page->content" />
        @endif
    </div>
</x-base-layout>
