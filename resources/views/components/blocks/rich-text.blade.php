@props([
    'data' => [
        'content' => '',
    ],
])

<div class="prose max-w-none dark:prose-invert">
    {!! App\Helpers::sanitizeRichText($data['content']) !!}
</div>
