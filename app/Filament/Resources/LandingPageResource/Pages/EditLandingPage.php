<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\LandingPageResource;

class EditLandingPage extends EditRecord
{
    protected static string $resource = LandingPageResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->url(route('landing-pages.show', $this->record))->openUrlInNewTab(),
        ]);
    }
}
