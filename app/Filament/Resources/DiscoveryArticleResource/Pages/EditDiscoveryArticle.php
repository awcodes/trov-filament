<?php

namespace App\Filament\Resources\DiscoveryArticleResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DiscoveryArticleResource;

class EditDiscoveryArticle extends EditRecord
{
    protected static string $resource = DiscoveryArticleResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->url(route('discovery-articles.show', $this->record))->openUrlInNewTab(),
        ]);
    }
}
