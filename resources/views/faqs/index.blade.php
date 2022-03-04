<x-base-layout :meta="$meta">

    @section('header')
        <x-headers.default />
    @endsection

    <div class="container py-8 lg:py-12">
        <x-blocks.heading :data="['level' => 'h1', 'content' => 'Frequently Asked Questions']" />

        <div class="mt-12 prose max-w-none">
            @if ($faqs)
                <ul>
                    @foreach ($faqs as $faq)
                        <li>
                            <div>{{ $faq['tag']->name }}</div>
                            <ul>
                                @foreach ($faq['faqs'] as $fq)
                                    <li><a href="{{ route('faqs.show', $fq) }}">{{ $fq->question }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    @section('footer')
        <x-footers.default />
    @endsection

</x-base-layout>
