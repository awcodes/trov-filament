<?php

namespace Trov\MediaLibrary\Components\Fields;

use Trov\MediaLibrary\Models\Media;
use Filament\Forms\Components\Field;

class MediaLibrary extends Field
{
    protected string $view = 'trov-media-library::fields.media-library';

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (MediaLibrary $component, Media $media, $state): void {
            $component->state($media->where('id', $state)->first());
        });

        $this->dehydrateStateUsing(function ($state): ?int {
            return isset($state['id']) ? $state['id'] : null;
        });
    }
}
