<div class="w-full max-w-sm">

    <x-filament::modal.heading class="mb-4">
        Edit Media
    </x-filament::modal.heading>

    @if ($file)
        <div class="h-64 bg-gray-700">
            <img src="{{ $file->thumb }}" alt="{{ $file->alt }}" width="{{ $file->width }}"
                height="{{ $file->alt }}" class="block object-cover h-full" />
        </div>
    @endif

    {{ $this->form }}

    <x-filament::button type="button" wire:click="handleAddToLibrary" class="mt-4">
        Save Media
    </x-filament::button>
</div>
