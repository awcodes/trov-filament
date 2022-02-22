<?php

namespace App\Http\Livewire;


use Filament\Forms;
use App\Models\Media;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Intervention\Image\Facades\Image;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class EditMedia extends Component implements HasForms
{
    use InteractsWithForms;

    public $file = null;
    public $alt;
    public $title;
    public $description;

    public $data;

    public function mount($mediaId = null): void
    {
        $this->file = Media::where('id', $mediaId)->first();

        $this->form->fill([
            'alt' => $this->file ? $this->file->alt : '',
            'title' => $this->file ? $this->file->title : '',
            'description' => $this->file ? $this->file->description : '',
        ]);
    }

    public function getMediaItem($mediaId = null)
    {
        $this->file = Media::where('id', $mediaId)->first();

        $this->form->fill([
            'alt' => $this->file ? $this->file->alt : '',
            'title' => $this->file ? $this->file->title : '',
            'description' => $this->file ? $this->file->description : '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('alt')->helperText('Describe this image. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('description')->rows(3),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function handleAddToLibrary(): void
    {
        $this->validate();

        $this->file->update([
            'alt' => $this->data['alt'],
            'title' => $this->data['title'],
            'description' => $this->data['description'],
        ]);

        $this->form->fill([
            'alt' => '',
            'title' => '',
            'description' => '',
        ]);
    }

    public function render(): View
    {
        return view('livewire.edit-media');
    }
}
