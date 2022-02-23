<x-forms::field-wrapper :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()" :hint="$getHint()" :hint-icon="$getHintIcon()" :required="$isRequired()"
    :state-path="$getStatePath()">
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <img x-bind:src="state?.large" x-bind:alt="state?.alt" x-bind:width="state?.width" x-bind:height="state?.height"
            x-bind:srcset="`${state?.url} 1200w, ${state?.large} 1024w, ${state?.medium} 640w`"
            sizes="(max-width: 1200px) 100vw, 1200px" loading="lazy" class="" />
    </div>
</x-forms::field-wrapper>
