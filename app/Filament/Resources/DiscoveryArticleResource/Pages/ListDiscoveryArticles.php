<?php

namespace App\Filament\Resources\DiscoveryArticleResource\Pages;

use App\Models\DiscoveryArticle;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;
use App\Filament\Resources\DiscoveryArticleResource;

class ListDiscoveryArticles extends ListRecords
{
    protected static string $resource = DiscoveryArticleResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'Article']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('preview')
                ->label('Preview Article')
                ->icon('heroicon-s-eye')
                ->url(fn (DiscoveryArticle $record): string => route('discovery-articles.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit Article')
                ->url(fn (DiscoveryArticle $record): string => route('filament.resources.discovery-articles.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
