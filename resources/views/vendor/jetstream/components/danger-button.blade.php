<button
    {{ $attributes->merge(['type' => 'button','class' =>'inline-flex items-center justify-center font-medium tracking-tight rounded-lg focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button dark:focus:ring-offset-0 h-9 px-4 text-white shadow focus:ring-white bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 filament-page-button-action']) }}>
    {{ $slot }}
</button>
