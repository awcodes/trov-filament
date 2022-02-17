<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use App\Traits\HasViewButton;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    use HasViewButton;

    protected static string $resource = FaqResource::class;
}
