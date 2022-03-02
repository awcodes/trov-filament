<?php

namespace Filament\Forms\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BelongsToManyCheckboxList extends CheckboxList
{
    protected string | Closure | null $displayColumnName = null;

    protected ?Closure $getOptionLabelFromRecordUsing = null;

    protected string | Closure | null $relationship = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (BelongsToManyCheckboxList $component, ?array $state): void {
            if (count($state ?? [])) {
                return;
            }

            $relationship = $component->getRelationship();
            $relatedModels = $relationship->getResults();

            $component->state(
                // Cast the related keys to a string, otherwise Livewire does not
                // know how to handle deselection.
                //
                // https://github.com/laravel-filament/filament/issues/1111
                $relatedModels
                    ->pluck($relationship->getRelatedKeyName())
                    ->map(fn ($key): string => strval($key))
                    ->toArray(),
            );
        });

        $this->saveRelationshipsUsing(function (BelongsToManyCheckboxList $component, ?array $state) {
            $component->getRelationship()->sync($state ?? []);
        });

        $this->dehydrated(false);
    }

    public function relationship(string | Closure $relationshipName, string | Closure $displayColumnName, ?Closure $callback = null): static
    {
        $this->displayColumnName = $displayColumnName;
        $this->relationship = $relationshipName;

        $this->options(function (BelongsToManyCheckboxList $component) use ($callback): array {
            $relationship = $component->getRelationship();

            $relationshipQuery = $relationship->getRelated()->query()->orderBy($component->getDisplayColumnName());

            if ($callback) {
                $relationshipQuery = $this->evaluate($callback, [
                    'query' => $relationshipQuery,
                ]);
            }

            if ($component->hasOptionLabelFromRecordUsingCallback()) {
                return $relationshipQuery
                    ->get()
                    ->map(fn (Model $record) => $component->getOptionLabelFromRecord($record))
                    ->toArray();
            }

            return $relationshipQuery
                ->pluck($component->getDisplayColumnName(), $relationship->getRelatedKeyName())
                ->toArray();
        });

        return $this;
    }

    public function getOptionLabelFromRecordUsing(?Closure $callback): static
    {
        $this->getOptionLabelFromRecordUsing = $callback;

        return $this;
    }

    public function hasOptionLabelFromRecordUsingCallback(): bool
    {
        return $this->getOptionLabelFromRecordUsing !== null;
    }

    public function getOptionLabelFromRecord(Model $record): string
    {
        return $this->evaluate($this->getOptionLabelFromRecordUsing, ['record' => $record]);
    }

    public function getDisplayColumnName(): string
    {
        return $this->evaluate($this->displayColumnName);
    }

    public function getLabel(): string
    {
        if ($this->label === null) {
            return (string) Str::of($this->getRelationshipName())
                ->before('.')
                ->kebab()
                ->replace(['-', '_'], ' ')
                ->ucfirst();
        }

        return parent::getLabel();
    }

    public function getRelationship(): BelongsToMany
    {
        return $this->getModelInstance()->{$this->getRelationshipName()}();
    }

    public function getRelationshipName(): string
    {
        return $this->evaluate($this->relationship);
    }
}
