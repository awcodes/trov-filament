<x-forms::field-wrapper :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()">

    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }"
        class="w-full">

        <x-filament::button x-show="!state"
            type="button"
            x-on:click="$dispatch('open-modal', {id: 'filament-media-gallery'})">
            Add Media
        </x-filament::button>

        <div x-show="state"
            style="display: none;"
            class="relative block w-full h-64 overflow-hidden transition duration-75 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <img x-bind:src="state?.large"
                x-bind:alt="state?.alt"
                x-bind:width="state?.width"
                x-bind:height="state?.height"
                class="object-cover h-full" />
            <button type="button"
                x-on:click="state = null"
                class="absolute flex items-center justify-center w-10 h-10 text-white rounded-full top-4 left-4 bg-black/75">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div x-data="{
            files: [],
            offset: 0,
            selected: [],
            fetchFiles: async function() {
                let response = await fetch(`/api/media-library/${this.offset}`);
                let json = await response.json();
                console.log(json.data);
                this.files = this.files.concat(json.data);
                this.offset = json.next;
            },
            setSelected: function(file) {
                if (this.selected && this.selected.id === file.id) {
                    this.selected = [];
                } else {
                    this.selected = file;
                }
            }
        }">
            <x-filament::modal id="filament-media-gallery"
                width="7xl">

                <x-slot name="header">
                    <div class="flex items-center justify-between">
                        <span>{{ __('Media Library') }}</span>
                        <x-filament::button type="button"
                            color="danger"
                            x-on:click="fetchFiles">
                            Fetch Media (remove this once working)
                        </x-filament::button>
                    </div>
                </x-slot>

                <div class="flex h-full">

                    <div class="flex-1">

                        <div x-show="files.length > 0"
                            class="flex flex-wrap gap-4">
                            <template x-for="file in files">
                                <button type="button"
                                    x-on:click="setSelected(file); {{ $setSelected() }}"
                                    class="overflow-hidden bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500"
                                    x-bind:class="{'ring-offset-1 ring-offset-gray-700 ring ring-primary-500': selected && selected.id === file.id}">
                                    <img x-bind:src="file.thumb"
                                        x-bind:alt="file.alt"
                                        width="125"
                                        height="125"
                                        class="block object-cover h-full" />
                                </button>
                            </template>
                        </div>

                        <p x-show="!files">No Media in the Library</p>

                    </div>

                    <div class="flex-shrink-0 w-full max-w-xs pl-4 border-l border-gray-300 dark:border-gray-900">

                        <div>
                            @if ($selected)
                                <div wire:ignore>
                                    @livewire('edit-mdia-form')
                                </div>
                            @else
                                <div wire:ignore>
                                    @livewire('create-media-form')
                                </div>
                            @endif
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
        </div>
    </div>
</x-forms::field-wrapper>
