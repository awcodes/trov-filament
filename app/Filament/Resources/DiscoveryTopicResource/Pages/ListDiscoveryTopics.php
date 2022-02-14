<?php

namespace App\Filament\Resources\DiscoveryTopicResource\Pages;

use App\Models\DiscoveryTopic;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;
use App\Filament\Resources\DiscoveryTopicResource;

class ListDiscoveryTopics extends ListRecords
{
    protected static string $resource = DiscoveryTopicResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'Topic']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('preview')
                ->label('Preview Topic')
                ->icon('heroicon-s-eye')
                ->url(fn (DiscoveryTopic $record): string => route('discovery-topics.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit Topic')
                ->url(fn (DiscoveryTopic $record): string => route('filament.resources.discovery-topics.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
