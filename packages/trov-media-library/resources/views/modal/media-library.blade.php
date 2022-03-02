<div x-data="{
        selected: $wire.entangle('selected'),
        fieldId: null
    }"
    class="trov-media-libary-modal">
    <x-trov-media-library::modal id="trov-media-gallery"
        width="7xl"
        x-on:open-modal.window="fieldId = $event.detail.fieldId">

        <x-slot name="header">
            {{ __('Media Library') }}
        </x-slot>

        <div class="flex h-full overflow-hidden"
            x-on:click.away="selected = []">

            <div class="flex-1 h-full pt-2 pb-2 pl-2 pr-6 overflow-scroll">
                @if ($files)
                    <ul class="grid grid-cols-3 gap-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8">
                        @foreach ($files as $file)
                            <li class="relative aspect-square">
                                <button type="button"
                                    wire:click.prevent="setSelected({{ $file['id'] }})"
                                    @class([
                                        'bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500',
                                        'ring-offset-1 ring-offset-gray-700 ring ring-primary-500 shadow-lg' =>
                                            $selected && $selected['id'] === $file['id'],
                                    ])>
                                    <img src="{{ $file['thumb'] }}"
                                        alt="{{ $file['alt'] }}"
                                        width="200"
                                        height="200"
                                        class="block object-cover h-full" />
                                </button>
                            </li>
                        @endforeach
                        <li class="relative aspect-square">
                            <button type="button"
                                wire:click.prevent="getFiles"
                                class="absolute inset-0 flex items-center justify-center bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                @else
                    <p>No Media in the Library</p>
                @endif

                </ul>

            </div>

            <div
                class="flex-shrink-0 w-full h-full max-w-xs pl-6 overflow-scroll border-l border-gray-300 dark:border-gray-700">

                @if ($selected)
                    <livewire:edit-media-form :file="$selected"
                        key="{{ now() }}" />
                @else
                    <livewire:create-media-form />
                @endif

            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end">
                <x-filament::button type="button"
                    color="success"
                    x-on:click="$dispatch('close-modal', {id: 'trov-media-gallery', media: selected, fieldId: fieldId})">
                    Use Selected Image
                </x-filament::button>
            </div>
        </x-slot>

    </x-trov-media-library::modal>
</div>
