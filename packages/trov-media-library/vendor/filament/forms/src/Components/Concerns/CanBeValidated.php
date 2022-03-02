<?php

namespace Filament\Forms\Components\Concerns;

use Closure;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

trait CanBeValidated
{
    protected bool | Closure $isRequired = false;

    protected array $rules = [];

    protected string | Closure | null $validationAttribute = null;

    public function exists(string | Closure | null $table = null, string | Closure | null $column = null, ?Closure $callback = null): static
    {
        $this->rule(function (Field $component, ?string $model) use ($callback, $column, $table) {
            $table = $component->evaluate($table) ?? $model;
            $column = $component->evaluate($column) ?? $component->getName();

            $rule = Rule::exists($table, $column);

            if ($callback) {
                $rule = $this->evaluate($callback, [
                    'rule' => $rule,
                ]);
            }

            return $rule;
        }, fn (Field $component, ?string $model): bool => (bool) ($component->evaluate($table) ?? $model));

        return $this;
    }

    public function nullable(bool | Closure $condition = true): static
    {
        $this->required(function (Field $component) use ($condition): bool {
            return ! $component->evaluate($condition);
        });

        return $this;
    }

    public function required(bool | Closure $condition = true): static
    {
        $this->isRequired = $condition;

        return $this;
    }

    public function rule(string | object $rule, bool | Closure $condition = true): static
    {
        $this->rules = array_merge(
            $this->rules,
            [[$rule, $condition]],
        );

        return $this;
    }

    public function rules(string | array $rules, bool | Closure $condition = true): static
    {
        if (is_string($rules)) {
            $rules = explode('|', $rules);
        }

        $this->rules = array_merge(
            $this->rules,
            array_map(fn (string | object $rule) => [$rule, $condition], $rules),
        );

        return $this;
    }

    public function after(string | Closure $date, bool $isStatePathAbsolute = false): static
    {
        return $this->dateComparisonRule('after', $date, $isStatePathAbsolute);
    }

    public function afterOrEqual(string | Closure $date, bool $isStatePathAbsolute = false): static
    {
        return $this->dateComparisonRule('after_or_equal', $date, $isStatePathAbsolute);
    }

    public function before(string | Closure $date, bool $isStatePathAbsolute = false): static
    {
        return $this->dateComparisonRule('before', $date, $isStatePathAbsolute);
    }

    public function beforeOrEqual(string | Closure $date, bool $isStatePathAbsolute = false): static
    {
        return $this->dateComparisonRule('before_or_equal', $date, $isStatePathAbsolute);
    }

    public function different(string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        return $this->fieldComparisonRule('different', $statePath, $isStatePathAbsolute);
    }

    public function gt(string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        return $this->fieldComparisonRule('gt', $statePath, $isStatePathAbsolute);
    }

    public function gte(string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        return $this->fieldComparisonRule('gte', $statePath, $isStatePathAbsolute);
    }

    public function lt(string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        return $this->fieldComparisonRule('lt', $statePath, $isStatePathAbsolute);
    }

    public function lte(string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        return $this->fieldComparisonRule('lte', $statePath, $isStatePathAbsolute);
    }

    public function same(string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        return $this->fieldComparisonRule('same', $statePath, $isStatePathAbsolute);
    }

    public function unique(string | Closure | null $table = null, string | Closure | null $column = null, Model | Closure $ignorable = null, ?Closure $callback = null): static
    {
        $this->rule(function (Field $component, ?string $model) use ($callback, $column, $ignorable, $table) {
            $table = $component->evaluate($table) ?? $model;
            $column = $component->evaluate($column) ?? $component->getName();
            $ignorable = $component->evaluate($ignorable);

            $rule = Rule::unique($table, $column)
                ->when(
                    $ignorable,
                    fn (Unique $rule) => $rule->ignore(
                        $ignorable->getOriginal($ignorable->getKeyName()),
                        $ignorable->getKeyName(),
                    ),
                );

            if ($callback) {
                $rule = $this->evaluate($callback, [
                    'rule' => $rule,
                ]);
            }

            return $rule;
        }, fn (Field $component, ?String $model): bool => (bool) ($component->evaluate($table) ?? $model));

        return $this;
    }

    public function validationAttribute(string | Closure | null $label): static
    {
        $this->validationAttribute = $label;

        return $this;
    }

    public function getRequiredValidationRule(): string
    {
        return $this->isRequired() ? 'required' : 'nullable';
    }

    public function getValidationAttribute(): string
    {
        return $this->evaluate($this->validationAttribute) ?? lcfirst($this->getLabel());
    }

    public function getValidationRules(): array
    {
        $rules = [
            $this->getRequiredValidationRule(),
        ];

        foreach ($this->rules as [$rule, $condition]) {
            if (is_numeric($rule)) {
                $rules[] = $this->evaluate($condition);
            } elseif ($this->evaluate($condition)) {
                $rules[] = $this->evaluate($rule);
            }
        }

        return $rules;
    }

    public function isRequired(): bool
    {
        return (bool) $this->evaluate($this->isRequired);
    }

    protected function dateComparisonRule(string $rule, string | Closure $date, bool $isStatePathAbsolute = false): static
    {
        $this->rule(function (Field $component) use ($date, $isStatePathAbsolute, $rule): string {
            $date = $component->evaluate($date);

            if (! (strtotime($date) && $isStatePathAbsolute)) {
                $containerStatePath = $component->getContainer()->getStatePath();

                if ($containerStatePath) {
                    $date = "{$containerStatePath}.{$date}";
                }
            }

            return "{$rule}:{$date}";
        }, fn (Field $component): bool => (bool) $component->evaluate($date));

        return $this;
    }

    protected function fieldComparisonRule(string $rule, string | Closure $statePath, bool $isStatePathAbsolute = false): static
    {
        $this->rule(function (Field $component) use ($isStatePathAbsolute, $rule, $statePath): string {
            $statePath = $component->evaluate($statePath);

            if (! $isStatePathAbsolute) {
                $containerStatePath = $component->getContainer()->getStatePath();

                if ($containerStatePath) {
                    $statePath = "{$containerStatePath}.{$statePath}";
                }
            }

            return "{$rule}:{$statePath}";
        }, fn (Field $component): bool => (bool) $component->evaluate($statePath));

        return $this;
    }
}
