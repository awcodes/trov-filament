<div class="space-y-6">

    <x-filament::modal.heading class="mb-4">
        Upload New Image
    </x-filament::modal.heading>

    {{ $this->form }}

    <x-filament::button type="submit"
        class="mt-4"
        wire:click.prevent="create"
        wire:loading.attr="disabled">
        Save
    </x-filament::button>

</div>
