<?php

namespace Filament\Forms\Components\Tabs;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Contracts\CanConcealComponents;
use Illuminate\Support\Str;

class Tab extends Component implements CanConcealComponents
{
    protected string $view = 'forms::components.tabs.tab';

    final public function __construct(string $label)
    {
        $this->label($label);
        $this->id(Str::slug($label));
    }

    public static function make(string $label): static
    {
        $static = app(static::class, ['label' => $label]);
        $static->setUp();

        return $static;
    }

    public function getId(): string
    {
        return $this->getContainer()->getParentComponent()->getId() . '-' . parent::getId() . '-tab';
    }
}
