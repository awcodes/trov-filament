@props(['content' => ''])
<div class="prose max-w-none">
    {!! App\Helpers::sanitizeRichText($content) !!}
</div>
