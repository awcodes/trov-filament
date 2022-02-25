<x-dynamic-component :component="$layout . '-layout'"
    :meta="$meta">

    @section('hero')
        hero should go here
    @endsection

    <div class="container py-8 lg:py-12">
        <p>content goes here</p>
    </div>
</x-dynamic-component>
