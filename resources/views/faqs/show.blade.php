<x-dynamic-component :component="$layout . '-layout'" :meta="$meta">

    <x-blocks.heading :data="['level' => 'h1', 'content' => $faq->question]" />

    <x-prose :content="$faq->answer" />

</x-dynamic-component>
