<button
    {{ $attributes->merge(['type' => 'submit','class' =>'inline-flex items-center justify-center font-medium tracking-tight rounded-lg focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button dark:focus:ring-offset-0 bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 px-4 text-white shadow focus:ring-white filament-page-button-action']) }}>
    {{ $slot }}
</button>
