<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Models\Faq;
use App\Filament\Resources\FaqResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;

class ListFaqs extends ListRecords
{
    protected static string $resource = FaqResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'FAQ']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('preview')
                ->label('Preview FAQ')
                ->icon('heroicon-s-eye')
                ->url(fn (Faq $record): string => route('faqs.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit FAQ')
                ->url(fn (Faq $record): string => route('filament.resources.faqs.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
