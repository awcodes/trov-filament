@props(['content' => ''])
<div class="prose max-w-none dark:prose-invert">
    {!! App\Helpers::sanitizeRichText($content) !!}
</div>
