<x-base-layout :meta="$meta">

    @section('header')
        <x-headers.default />
    @endsection

    <div class="py-8 wrapper lg:py-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => $faq->question]" />

        <x-prose>
            {!! $faq->answer !!}
        </x-prose>
    </div>

    @section('footer')
        <x-footers.default />
    @endsection

</x-base-layout>
