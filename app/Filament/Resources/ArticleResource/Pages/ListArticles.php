<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Models\Article;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ArticleResource;
use Filament\Tables\Actions\IconButtonAction;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

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
