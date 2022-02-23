<?php

namespace App\Filament\Resources\DiscoveryTopicResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DiscoveryTopicResource;
use App\Traits\HasViewAndSaveButtons;

class EditDiscoveryTopic extends EditRecord
{
    use HasViewAndSaveButtons;

    protected static string $resource = DiscoveryTopicResource::class;
}
