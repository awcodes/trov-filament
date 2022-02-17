<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Models\Faq;
use App\Traits\HasCustomTableActions;
use App\Filament\Resources\FaqResource;
use Filament\Resources\Pages\ListRecords;

class ListFaqs extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = FaqResource::class;

    protected function getTitle(): string
    {
        return 'FAQs';
    }
}
