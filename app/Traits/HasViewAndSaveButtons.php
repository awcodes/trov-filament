<?php

namespace App\Traits;

use Filament\Pages\Actions\ButtonAction;

trait HasViewAndSaveButtons
{
    public function getActions(): array
    {
        parent::getActions();

        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->color('gray')->url($this->record->getPublicUrl())->openUrlInNewTab(),
            ButtonAction::make('save')->action('saveFormFromAction'),
        ]);
    }

    public function saveFormFromAction(): void
    {
        $this->save();
    }
}
