<?php

namespace App\Filament\Resources\DiscoveryTopicResource\Pages;

use App\Filament\Resources\DiscoveryTopicResource;
use App\Traits\HasMediaLibrary;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscoveryTopic extends CreateRecord
{
    use HasMediaLibrary;

    protected static string $resource = DiscoveryTopicResource::class;
}
