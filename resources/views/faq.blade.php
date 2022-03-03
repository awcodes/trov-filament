<x-base-layout :meta="$meta">

    @section('header')
        <x-headers.default />
    @endsection

    <div class="container py-8 lg:py-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => $faq->question]" />

        <x-prose :content="$faq->answer" />
    </div>

    @section('footer')
        <x-footers.default />
    @endsection

</x-base-layout>
