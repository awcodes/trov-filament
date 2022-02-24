<?php

namespace AWCodes\FilamentMediaLibrary\Components;

use App\Models\Media;
use Livewire\Component;
use Filament\Facades\Filament;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class EditMediaForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Media $media;

    public $alt;
    public $title;
    public $caption;
    public $description;

    public function mount(Media $media)
    {
        $this->media = $media;

        $this->form->fill([
            'alt' => $this->media->alt,
            'title' => $this->media->title,
            'caption' => $this->media->caption,
            'description' => $this->media->description,
        ]);
    }

    protected function getFormModel(): string
    {
        return Media::class;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('caption')->rows(3),
            Textarea::make('description')->rows(3),
        ];
    }

    public function create(): void
    {
        $this->media->update($this->form->getState());
    }

    public function render()
    {
        return view('filament-media-library::edit-media-form');
    }
}
