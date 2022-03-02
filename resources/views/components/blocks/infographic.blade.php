<div x-data="{
    decodeHTML(html) {
        var txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    },
    copyEmbedCode: function() {
        let parsedText = this.decodeHTML({{ $embedCode }});
        navigator.clipboard.writeText(parsedText).then(
            function() {
                window.alert('Success! The embed code was copied to your clipboard');
            },
            function() {
                window.alert('Opps! Your browser does not support the Clipboard API');
            }
        );
    }
}"
    x-id="['infographic']"
    class="mt-4">
    <a href="{{ $media->url }}"
        target="_blank"
        rel="noopener">
        <img src="{{ $media->url }}"
            alt="{{ $media->alt }}"
            width="{{ $media->width }}"
            height="{{ $media->height }}"
            srcset="
                {{ $media->url }} 1200w,
                {{ $media->large }} 1024w,
                {{ $media->medium }} 640w
            "
            sizes="(max-width: 1200px) 100vw, 1200px"
            loading="lazy"
            @if ($transcript) :aria-describedby="$id('infographic') + '-transcript'" @endif
            class="" />
    </a>

    <div class="embed-infographic">
        <p>{{ __('Would you like to embed this infographic on your site?') }}</p>
        <button type="button"
            x-on:click="copyEmbedCode">Copy Embed Code</button>
    </div>

    @if ($transcript)
        <div :id="$id('infographic') + '-transcript'"
            class="sr-only"
            aria-label="extended text alternative for infographic">
            {!! $transcript !!}
        </div>
    @endif

</div>
