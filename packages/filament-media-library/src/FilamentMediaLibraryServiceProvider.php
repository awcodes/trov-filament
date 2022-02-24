<?php

namespace AWCodes\FilamentMediaLibrary;

use Livewire\Livewire;
use Livewire\Component;
use Illuminate\Support\Str;
use Filament\PluginServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelPackageTools\Package;

class FilamentMediaLibraryServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-media-library')->hasViews();
    }

    public function boot()
    {
        parent::boot();

        Livewire::component('create-media-form', Components\CreateMediaForm::class);
        Livewire::component('edit-media-form', Components\EditMediaForm::class);
    }
}
