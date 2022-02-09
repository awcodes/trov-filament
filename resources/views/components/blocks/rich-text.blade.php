@props([
    'data' => [
        'content' => '',
    ],
])

<div class="prose max-w-none">
    {!! App\Helpers::sanitizeRichText($data['content']) !!}
</div>
