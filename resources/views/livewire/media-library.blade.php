<div x-data="{
    files: @entangle('files'),
}" class="flex h-full">
    <div class="flex-1">
        @if ($files)
            <div class="grid grid-cols-8 gap-4">
                @foreach ($files as $file)
                    <div>
                        <button type="button" wire:click="getMediaItem({{ $file['id'] }})"
                            class="h-full bg-gray-700 {{ $selected && $selected['id'] === $file['id']? 'ring-offset-1 ring-offset-gray-700 ring ring-primary-500': 'focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500' }}">
                            <img src="{{ $file['thumb'] }}" alt="{{ $file['alt'] }}" width="150" height="150"
                                class="block object-cover h-full" />
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <p>No Media in the Library</p>
        @endif
    </div>
    <div class="flex-shrink-0 w-full max-w-xs">
        @if ($selected)
            <form class="w-full max-w-sm">

                <x-filament::modal.heading class="mb-4">
                    Edit Media
                </x-filament::modal.heading>

                <div class="h-64 mb-4 bg-gray-700">
                    <img src="{{ $selected['medium'] }}" alt="{{ $selected['alt'] }}"
                        width="{{ $selected['width'] }}" height="{{ $selected['alt'] }}"
                        class="block object-cover h-full" />
                </div>

                {{ $this->editForm }}

                <x-filament::button type="submit" class="mt-4" wire:click.prevent="handleEdit"
                    wire:loading.attr="disabled">
                    Save Media
                </x-filament::button>
            </form>
        @else
            <form class="w-full max-w-sm">

                <x-filament::modal.heading class="mb-4">
                    Upload New Image
                </x-filament::modal.heading>

                {{ $this->createForm }}

                <x-filament::button type="submit" class="mt-4" wire:click.prevent="handleCreate"
                    wire:loading.attr="disabled">
                    Save
                </x-filament::button>
            </form>
            {{-- <livewire:add-media-to-library /> --}}
        @endif
    </div>
</div>
