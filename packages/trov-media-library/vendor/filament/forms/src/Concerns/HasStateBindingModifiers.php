<?php

namespace Filament\Forms\Concerns;

use Filament\Forms\Components\Component;

trait HasStateBindingModifiers
{
    protected $stateBindingModifiers = null;

    public function reactive(): static
    {
        $this->stateBindingModifiers([]);

        return $this;
    }

    public function lazy(): static
    {
        $this->stateBindingModifiers(['lazy']);

        return $this;
    }

    public function stateBindingModifiers(array $modifiers): static
    {
        $this->stateBindingModifiers = $modifiers;

        return $this;
    }

    public function applyStateBindingModifiers($expression): string
    {
        $modifiers = $this->getStateBindingModifiers();

        return implode('.', array_merge([$expression], $modifiers));
    }

    public function getStateBindingModifiers(): array
    {
        if ($this->stateBindingModifiers !== null) {
            return $this->stateBindingModifiers;
        }

        if ($this instanceof Component) {
            return $this->getContainer()->getStateBindingModifiers();
        }

        if ($this->getParentComponent()) {
            return $this->getParentComponent()->getStateBindingModifiers();
        }

        return ['defer'];
    }
}
