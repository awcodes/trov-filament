<div x-data="{
    files: @entangle('files'),
}" class="flex h-full">
    <div class="flex-1">
        @if ($files)
            <div class="flex flex-wrap gap-4">
                @foreach ($files as $file)
                    <div>
                        <button type="button" wire:click="getMediaItem({{ $file['id'] }})"
                            class="h-full bg-gray-700 {{ $selected && $selected['id'] === $file['id']? 'ring-offset-1 ring-offset-gray-700 ring ring-primary-500': 'focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500' }}">
                            <img src="{{ $file['thumb'] }}" alt="{{ $file['alt'] }}" width="125" height="125"
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
        <form
            class="w-full max-w-sm p-6 space-y-6 border border-gray-300 shadow-sm rounded-xl bg-gray-50 dark:border-gray-800 dark:bg-gray-800/50">
            @if ($selected)
                <x-filament::modal.heading class="mb-4">
                    Edit Media
                </x-filament::modal.heading>

                <div class="mb-4 overflow-hidden bg-gray-700 border border-gray-600 rounded">
                    <img src="{{ $selected['url'] }}" alt="{{ $selected['alt'] }}"
                        width="{{ $selected['width'] }}" height="{{ $selected['height'] }}"
                        class="block object-cover h-full" />
                </div>

                {{ $this->editForm }}

                <div class="flex items-center gap-3 mt-4">
                    <x-filament::button type="submit" wire:click.prevent="handleEdit" wire:loading.attr="disabled">
                        Save
                    </x-filament::button>
                    <x-filament::button type="button" color="danger" wire:click.prevent="destroyFile"
                        wire:loading.attr="disabled">
                        Delete
                    </x-filament::button>
                </div>
            @else
                <x-filament::modal.heading class="mb-4">
                    Upload New Image
                </x-filament::modal.heading>

                {{ $this->createForm }}

                <x-filament::button type="submit" class="mt-4" wire:click.prevent="handleCreate"
                    wire:loading.attr="disabled">
                    Save
                </x-filament::button>
            @endif
        </form>
    </div>
</div>
