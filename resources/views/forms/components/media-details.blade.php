<x-forms::field-wrapper :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()" :hint="$getHint()" :hint-icon="$getHintIcon()" :required="$isRequired()"
    :state-path="$getStatePath()">
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <p>Uploaded on: <span x-text="state?.uploaded"></span></p>
        <p>File URL: <span x-text="state?.url"></span></p>
        <p>File name: <span x-text="state?.name"></span></p>
        <p>File type: <span x-text="state?.type"></span></p>
        <p>File size: <span x-text="state?.size"></span></p>
        <p>Dimensions: <span x-text="state?.width"></span> x <span x-text="state?.height"></span></p>
    </div>
</x-forms::field-wrapper>
