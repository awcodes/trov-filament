<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Models\Article;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ArticleResource;
use Filament\Tables\Actions\IconButtonAction;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

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
                ->url(fn (Article $record): string => route('articles.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit Article')
                ->url(fn (Article $record): string => route('filament.resources.articles.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
