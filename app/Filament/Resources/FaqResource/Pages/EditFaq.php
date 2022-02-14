<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->url(route('faqs.show', $this->record))->openUrlInNewTab(),
        ]);
    }
}
