<div x-data="mediaLibrary" x-on:open-media-library.window="isOpen = true; fetchMedia();" aria-labelledby="modal-header"
    role="dialog" aria-modal="true" class="filament-modal">
    <div x-show="isOpen" x-transition:enter="ease duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;"
        class="fixed inset-0 z-40 flex items-center min-h-screen p-4 overflow-y-auto transition">
        <button x-on:click="isOpen = false" type="button" aria-hidden="true"
            class="fixed inset-0 w-full h-full bg-black/50 focus:outline-none filament-modal-close-overlay"></button>

        <div x-show="isOpen" x-trap="isOpen" x-on:keydown.window.escape="isOpen = false"
            x-transition:enter="ease duration-300" x-transition:enter-start="translate-y-8"
            x-transition:enter-end="translate-y-0" x-transition:leave="ease duration-300"
            x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-8" style="display: none;"
            class="relative w-full h-full p-4 mt-auto cursor-pointer md:mb-auto">
            <div @class([
                'w-full h-full mx-auto p-2 space-y-2 bg-white rounded-xl cursor-default filament-modal-window',
                'dark:bg-gray-800' => config('tables.dark_mode'),
            ])>
                <form class="flex flex-col h-full">
                    <div class="px-4 py-2 filament-modal-header" id="modal-header">
                        {{ __('Media Library') }}
                    </div>

                    <x-filament::hr />

                    <div class="flex-1 space-y-2 filament-modal-content">
                        <div class="flex h-full">
                            <div class="flex-1 p-4">
                                <div class="grid grid-cols-8 gap-4">
                                    <template x-for="file in files">
                                        <div>
                                            <button type="button" x-on:click="addToSelection(file)"
                                                class="h-full bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500"
                                                x-bind:class="{
                                                        'ring-offset-1 ring-offset-gray-700 ring ring-primary-500': selected && selected.id === file.id,
                                                    }">
                                                <img x-bind:src="file.thumb" x-bind:alt="file.alt" width="150"
                                                    height="150" class="block object-cover h-full" />
                                            </button>
                                        </div>
                                    </template>
                                </div>
                                <p x-text="message"></p>
                                <button type="button" x-on:click="fetchMedia()">Fetch Media</button>
                            </div>
                            <div class="w-full max-w-sm p-4">
                                <livewire:add-media-to-library />
                            </div>
                        </div>
                    </div>

                    <x-filament::hr />

                    <div class="flex justify-end px-4 py-2 filament-modal-footer">
                        <x-filament::button type="button" x-on:click="handleSelect">Use Selected Image
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("mediaLibrary", () => ({
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
            }));
        });
    </script>
</div>
