<x-base-layout :meta="$meta">

    <div class="container py-8 lg:py-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => $faq->question]" />

        <x-prose :content="$faq->answer" />
    </div>

</x-base-layout>
