<?php

namespace AWCodes\FilamentMediaLibrary\Components;

use Filament\Forms\Components\Field;

class MediaLibrary extends Field
{
    protected string $view = 'filament-media-library::media-library';

    protected function setUp(): void
    {
        $this->afterStateHydrated(function (self $component, ?string $state): void {
            $component->state($state);
        });
    }
}
