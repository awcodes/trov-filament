<x-forms::field-wrapper :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()">

    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }"
        x-on:update-media-image.window="state = $event.detail.media"
        class="w-full">

        <x-filament::button x-show="!state"
            type="button"
            x-on:click="$dispatch('open-media-library')">
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
    </div>
</x-forms::field-wrapper>

@once
    @push('scripts')
        @livewire('media-library-modal')
    @endpush
@endonce
