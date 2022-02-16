<div class="w-full max-w-sm p-4">

    <x-filament::modal.heading class="mb-4">
        Upload New Image
    </x-filament::modal.heading>

    {{ $this->form }}

    <x-filament::button type="button" wire:click="handleAddToLibrary" class="mt-4">
        Save Image
    </x-filament::button>
</div>