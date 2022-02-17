<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\View\View;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function afterCreate(): void
    {
        $heroImage = $this->record->getMedia('hero_images')->first();
        $heroImage->setCustomProperty('alt', $this->data['hero_image_alt'])->save();
    }

    protected function getFooter(): ?View
    {
        return view('media-library');
    }
}
