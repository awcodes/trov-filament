@props([
    'sidebar' => null,
])
<div class="wrapper">
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">{{ $slot }}</div>
        <aside class="py-8 lg:col-span-1 lg:py-12">{{ $sidebar }}</aside>
    </div>
</div>
