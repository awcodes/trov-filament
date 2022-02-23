<div x-data="{
            isOpen: false,
            files: [],
            selected: null,
            message: 'Loading media...',
            fetchMedia: async function() {
                if (this.files.length < 1) {
                    const response = await fetch('/api/media-library');
                    const data = await response.json();
                    if (data.length > 0) {
                        this.files = data;
                        this.message = null;
                    } else {
                        this.message = 'No media in the library.'
                    }
                }
            },
            addToSelection: function(file) {
                this.selected = file;
            },
            handleSelect() {
                this.$dispatch('update-media-image', {
                    media: this.selected
                });
                this.isOpen = false;
                this.selected = false;
            }
    }"
    x-on:open-media-library.window="isOpen = true; fetchMedia();"
    aria-labelledby="modal-header"
    role="dialog"
    aria-modal="true"
    class="filament-modal">

    <div x-show="isOpen"
        x-transition:enter="ease duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;"
        class="fixed inset-0 z-40 flex items-center min-h-screen p-8 overflow-y-auto transition">

        <button x-on:click="isOpen = false"
            type="button"
            aria-hidden="true"
            class="fixed inset-0 w-full h-full bg-black/50 focus:outline-none filament-modal-close-overlay"></button>

        <div x-show="isOpen"
            x-trap="isOpen"
            x-on:keydown.window.escape="isOpen = false"
            x-transition:enter="ease duration-300"
            x-transition:enter-start="translate-y-8"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="ease duration-300"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-8"
            style="display: none;"
            class="relative w-full h-full mt-auto cursor-pointer md:mb-auto">

            <div
                class="w-full h-full mx-auto space-y-2 bg-white cursor-default rounded-xl dark:bg-gray-800 filament-modal-window">

                <form class="flex flex-col h-full">

                    <div class="flex items-center justify-between px-4 py-2 filament-modal-header"
                        id="modal-header">
                        <span>{{ __('Media Library') }}</span>
                        <x-filament::button type="button"
                            color="danger"
                            x-on:click="fetchMedia()">Fetch Media (remove this once working)</x-filament::button>
                    </div>

                    <x-filament::hr />

                    <div class="flex-1 space-y-2 filament-modal-content">

                        <div x-data="{}"
                            class="flex h-full">

                            <div class="flex-1 p-4">

                                <div class="flex flex-wrap gap-4">

                                    <template x-for="file in files">
                                        <div>
                                            <button type="button"
                                                x-on:click="addToSelection(file)"
                                                class="h-full bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500"
                                                x-bind:class="{'ring-offset-1 ring-offset-gray-700 ring ring-primary-500': selected && selected.id === file.id}">
                                                <img x-bind:src="file.thumb"
                                                    x-bind:alt="file.alt"
                                                    width="125"
                                                    height="125"
                                                    class="block object-cover h-full" />
                                            </button>
                                        </div>
                                    </template>

                                </div>

                                <p x-text="message"></p>


                            </div>
                            <div class="flex-shrink-0 w-full max-w-xs p-4">
                                <div
                                    class="w-full max-w-sm p-6 space-y-6 border border-gray-300 shadow-sm rounded-xl bg-gray-50 dark:border-gray-700 dark:bg-gray-700/50">
                                    <div x-show="selected"
                                        style="display: none;">
                                        <x-filament::modal.heading class="mb-4">
                                            Edit Media
                                        </x-filament::modal.heading>

                                        <div class="mb-4 overflow-hidden bg-gray-700 border border-gray-600 rounded">
                                            <img x-bind:src="selected?.url"
                                                x-bind:alt="selected?.alt"
                                                x-bind:width="selected?.width"
                                                x-bind:height="selected?.height"
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
                                    <div x-show="!selected"
                                        style="display: none;">
                                        <x-filament::modal.heading class="mb-4">
                                            Upload New Image
                                        </x-filament::modal.heading>

                                        {{-- {{ $this->createForm }} --}}

                                        <x-filament::button type="submit"
                                            class="mt-4"
                                            wire:click.prevent="handleCreate"
                                            wire:loading.attr="disabled">
                                            Save
                                        </x-filament::button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-filament::hr />

                    <div class="flex justify-end p-4 filament-modal-footer">
                        <x-filament::button type="button"
                            x-on:click="handleSelect">
                            Use Selected Image
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
