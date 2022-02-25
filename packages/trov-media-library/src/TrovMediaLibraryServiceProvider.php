<?php

namespace Trov\MediaLibrary;

use Livewire\Livewire;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Trov\MediaLibrary\Resources\MediaResource;

class TrovMediaLibraryServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        MediaResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('trov-media-library')
            ->hasViews()
            ->hasMigration('create_media_table');
    }

    public function boot()
    {
        parent::boot();

        Livewire::component('media-library', Components\MediaLibrary::class);
        Livewire::component('create-media-form', Components\Forms\CreateMediaForm::class);
        Livewire::component('edit-media-form', Components\Forms\EditMediaForm::class);
    }
}
