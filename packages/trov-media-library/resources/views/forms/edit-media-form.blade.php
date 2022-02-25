<div class="space-y-6">

    <x-filament::modal.heading class="mb-4">
        Edit Media
    </x-filament::modal.heading>

    <div class="mb-4 overflow-hidden bg-gray-700 border border-gray-600 rounded">
        <img src="{{ $media['url'] }}"
            alt="{{ $media['alt'] }}"
            width="{{ $media['width'] }}"
            height="{{ $media['height'] }}"
            class="block object-cover h-full" />
    </div>

    {{ $this->form }}

    <div class="flex items-center gap-3 mt-4">

        <x-filament::button type="submit"
            wire:click.prevent="update">
            Save
        </x-filament::button>

        <x-filament::button type="button"
            color="danger"
            wire:click.prevent="destroy">
            Delete
        </x-filament::button>

    </div>

</div>
