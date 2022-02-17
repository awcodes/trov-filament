<?php

namespace App\Traits;

use Filament\Pages\Actions\ButtonAction;

trait HasViewButton
{
    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->url($this->record->getPublicUrl())->openUrlInNewTab(),
        ]);
    }
}
