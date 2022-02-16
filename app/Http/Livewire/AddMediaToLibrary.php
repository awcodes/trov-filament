<?php

namespace App\Http\Livewire;


use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class AddMediaToLibrary extends Component implements HasForms
{
    use InteractsWithForms;

    public $image;
    public $alt;
    public $title;
    public $description;

    public function mount(): void
    {
        $this->form->fill([
            'file' => '',
            'alt' => '',
            'title' => '',
            'description' => '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('file')
                ->image()
                ->maxFiles(1)
                ->maxWidth(5000)
                ->imageCropAspectRatio('16:9')
                ->imageResizeTargetWidth('1920')
                ->imageResizeTargetHeight('1080')
                ->required(),
            TextInput::make('alt')->helperText('Describe this image. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('description')->rows(3),
        ];
    }

    public function handleAddToLibrary(): void
    {
        $this->validate();

        // Process image and save to database
    }

    public function render(): View
    {
        return view('livewire.add-media-to-library');
    }
}
