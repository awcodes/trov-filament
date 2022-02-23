<?php

namespace App\Http\Livewire;


use Filament\Forms;
use App\Models\Media;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class AddMediaToLibrary extends Component implements HasForms
{
    use InteractsWithForms;

    public $file = '';
    public $alt = '';
    public $title = '';
    public $description = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Hidden::make('public_id'),
            Hidden::make('filename'),
            Hidden::make('ext'),
            Hidden::make('type'),
            Hidden::make('width'),
            Hidden::make('height'),
            Hidden::make('disk'),
            Hidden::make('size'),
            FileUpload::make('image_upload')
                ->maxFiles(1)
                ->maxWidth(5000)
                ->imageResizeTargetWidth('1920')
                ->preserveFilenames()
                ->required()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml', 'application/pdf'])
                ->saveUploadedFileUsing(function ($state, $set) {
                    foreach ($state as $file) {
                        $originalName = $file->getClientOriginalName();
                        $basename = pathinfo($originalName, PATHINFO_FILENAME);
                        $result = $file->storeOnCloudinaryAs(config('cloudinary.folder'), $basename);

                        $set('public_id', $result->getPublicId());
                        $set('filename', $basename);
                        $set('ext', $result->getExtension());
                        $set('type', $result->getFileType());
                        $set('width', $result->getWidth());
                        $set('height', $result->getHeight());
                        $set('disk', 'cloudinary');
                        $set('size', $result->getSize());
                    }

                    return '';
                }),
            TextInput::make('alt')->helperText('Describe this image. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('description')->rows(3),
        ];
    }

    public function handleAddToLibrary(): void
    {
        Media::create($this->form->getState());

        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.add-media-to-library');
    }
}
