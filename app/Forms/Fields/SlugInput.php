<?php

namespace App\Forms\Fields;

use Closure;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\Support\Arrayable;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Concerns\HasPlaceholder;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Concerns\HasExtraAlpineAttributes;
use Filament\Forms\Components\TextInput;

class SlugInput extends TextInput
{
    protected string $view = 'components.slug-input';

    protected string | Closure | null $mode = 'create';

    protected bool $cancelled = false;

    public function mode(string | Closure | null $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->evaluate($this->mode);
    }

    public function cancelChange()
    {
        return null;
    }
}
