@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium leading-4 text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
