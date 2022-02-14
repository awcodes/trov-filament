<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('preview')
                ->label('Preview Post')
                ->icon('heroicon-s-eye')
                ->url(fn (Post $record): string => route('posts.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit Post')
                ->url(fn (Post $record): string => route('filament.resources.posts.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
