<?php

namespace Trov\MediaLibrary\Resources\MediaResource\Pages;

use Illuminate\Support\Facades\Storage;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use Trov\MediaLibrary\Resources\MediaResource;

class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    public function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->color('gray')->url($this->record->url)->openUrlInNewTab(),
            ButtonAction::make('save')->action('saveFormFromAction'),
        ]);
    }

    public function saveFormFromAction(): void
    {
        $this->save();
    }
}
