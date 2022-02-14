<?php

namespace App\Filament\Resources\DiscoveryTopicResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DiscoveryTopicResource;

class EditDiscoveryTopic extends EditRecord
{
    protected static string $resource = DiscoveryTopicResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->url(route('discovery-topics.show', $this->record))->openUrlInNewTab(),
        ]);
    }
}
