<x-forms::field-wrapper :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()" :hint="$getHint()" :hint-icon="$getHintIcon()" :required="$isRequired()"
    :state-path="$getStatePath()">
    <div x-data="{
            state: $wire.entangle('{{ $getStatePath() }}'),
            original: '',
            disabled: {{ $getMode() == 'edit' ? 'true' : 'false' }},
            init: function() { this.original = this.state; }
        }">
        <div
            {{ $attributes->merge($getExtraAttributes())->class(['flex items-center space-x-2 group filament-forms-text-input-component']) }}>

            <div class="flex-1">
                @if ($getMode == 'edit')
                    <input type="text" x-model="original" x-bind:disabled="disabled" id="{{ $getId() }}"
                        {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!} {!! $isRequired() ? 'required' : null !!}
                        {{ $getExtraInputAttributeBag()->class(['block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70','dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),'border-gray-300' => !$errors->has($getStatePath()),'dark:border-gray-600' => !$errors->has($getStatePath()) && config('forms.dark_mode'),'border-danger-600 ring-danger-600' => $errors->has($getStatePath())]) }} />

                    <input type="hidden" {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}" />
                @else
                    <input type="text" {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                        id="{{ $getId() }}" {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!} {!! $isRequired() ? 'required' : null !!}
                        {{ $getExtraInputAttributeBag()->class(['block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70','dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),'border-gray-300' => !$errors->has($getStatePath()),'dark:border-gray-600' => !$errors->has($getStatePath()) && config('forms.dark_mode'),'border-danger-600 ring-danger-600' => $errors->has($getStatePath())]) }} />
                @endif
            </div>

            @if ($getMode() == 'edit')
                <div>
                    <x-filament::button color="gray" x-show="disabled" x-on:click="disabled = false"
                        style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        <span class="sr-only">Edit</span>
                    </x-filament::button>
                    <x-filament::button color="primary" x-show="!disabled" style="display: none;"
                        x-on:click="state = original; disabled = true;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Save</span>
                    </x-filament::button>
                    <x-filament::button color="danger" x-show="!disabled" x-on:click="disabled = true"
                        style="display: none;" x-on:click="original = state; disabled = true;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Cancel</span>
                    </x-filament::button>
                </div>
            @endif
        </div>


    </div>

</x-forms::field-wrapper>
