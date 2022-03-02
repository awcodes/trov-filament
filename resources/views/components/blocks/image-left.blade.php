<div>
    <div class="flex gap-4 mt-4 block-image-left">
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
            class="max-w-md" />
        <div>
            {!! $content !!}
        </div>
    </div>
</div>
