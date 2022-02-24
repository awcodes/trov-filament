<x-filament::modal id="filament-media-gallery"
    width="7xl">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span>{{ __('Media Library') }}</span>
            <x-filament::button type="button"
                color="danger"
                wire:click.prevent="fetchFiles">Fetch Media (remove this once working)
            </x-filament::button>
        </div>
    </x-slot>

    <div class="flex-1 space-y-2 filament-modal-content">

        <div class="flex h-full">

            <div class="flex-1 p-4">

                <div class="flex flex-wrap gap-4">

                    @forelse($files as $file)
                        <div>
                            <button type="button"
                                wire:click.prevent="setSelected({{ $file['id'] }})"
                                @class([
                                    'h-full bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500',
                                    'ring-offset-1 ring-offset-gray-700 ring ring-primary-500' =>
                                        $selected && $selected['id'] === $file['id'],
                                ])>
                                <img src="{{ $file['thumb'] }}"
                                    alt="{{ $file['alt'] }}"
                                    width="125"
                                    height="125"
                                    class="block object-cover h-full" />
                            </button>
                        </div>
                    @empty
                        <p>No Media in the Library</p>
                    @endforelse

                </div>

            </div>

            <div class="flex-shrink-0 w-full max-w-xs p-4">

                <div
                    class="w-full max-w-sm p-6 space-y-6 border border-gray-300 shadow-sm rounded-xl bg-gray-50 dark:border-gray-700 dark:bg-gray-700/50">
                    @if ($selected)
                        <div>
                            <x-filament::modal.heading class="mb-4">
                                Edit Media
                            </x-filament::modal.heading>

                            <div class="mb-4 overflow-hidden bg-gray-700 border border-gray-600 rounded">
                                <img src="{{ $selected['url'] }}"
                                    alt="{{ $selected['alt'] }}"
                                    width="{{ $selected['width'] }}"
                                    height="{{ $selected['height'] }}"
                                    class="block object-cover h-full" />
                            </div>

                            {{-- {{ $this->editForm }} --}}

                            <div class="flex items-center gap-3 mt-4">
                                <x-filament::button type="submit"
                                    wire:click.prevent="handleEdit"
                                    wire:loading.attr="disabled">
                                    Save
                                </x-filament::button>
                                <x-filament::button type="button"
                                    color="danger"
                                    wire:click.prevent="destroyFile"
                                    wire:loading.attr="disabled">
                                    Delete
                                </x-filament::button>
                            </div>
                        </div>
                    @else
                        <div>
                            <x-filament::modal.heading class="mb-4">
                                Upload New Image
                            </x-filament::modal.heading>

                            @livewire('create-media-form')

                            <x-filament::button type="submit"
                                class="mt-4"
                                wire:click.prevent="handleCreate"
                                wire:loading.attr="disabled">
                                Save
                            </x-filament::button>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>

    <x-slot name="footer">
        <x-filament::button type="button"
            wire:click.prevent="handleSelect()">
            Use Selected Image
        </x-filament::button>
    </x-slot>

</x-filament::modal>
