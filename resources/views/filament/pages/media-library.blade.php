<x-filament::page>
    <div x-data="mediaLibraryStatic" class="flex h-full">
        <div class="flex-1">
            <div class="grid grid-cols-8 gap-4">
                <template x-for="file in files">
                    <div>
                        <button type="button" x-on:click="addToSelection(file)"
                            class="h-full bg-gray-700 focus:outline-none focus:ring-offset-1 focus:ring-offset-gray-700 focus:ring focus:ring-primary-500"
                            x-bind:class="{'ring-offset-1 ring-offset-gray-700 ring ring-primary-500': selected && selected.id === file.id}">
                            <img x-bind:src="file.thumb" x-bind:alt="file.alt" width="150" height="150"
                                class="block object-cover h-full" />
                        </button>
                    </div>
                </template>
            </div>
            <p x-text="message"></p>
        </div>
        <div class="w-full max-w-xs">
            <livewire:add-media-to-library />
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("mediaLibraryStatic", () => ({
                isOpen: false,
                files: [],
                selected: null,
                message: 'Loading media...',
                init: async function() {
                    await this.fetchMedia();
                },
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
</x-filament::page>
