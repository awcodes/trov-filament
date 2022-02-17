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

class AddMediaToLibrary extends Component implements HasForms
{
    use InteractsWithForms;

    public $file;
    public $alt;
    public $title;
    public $description;

    public $data;

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
                ->imageResizeTargetWidth('1920')
                ->preserveFilenames()
                ->required(),
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

        // Process image and save to database
        // $tempFile = reset($this->file);
        // $originalName = $tempFile->getClientOriginalName();
        // $basename = pathinfo($originalName, PATHINFO_FILENAME);
        // $file = Image::make($tempFile->getRealPath())->fit(1920, 1080, function ($constraint) {
        //     $constraint->upsize();
        // })->encode(null, 100);

        foreach ($this->data['file'] as $file) {
            $originalName = $file->getClientOriginalName();
            $basename = pathinfo($originalName, PATHINFO_FILENAME);
            $result = $file->storeOnCloudinaryAs(env('CLOUDINARY_FOLDER'), $basename);

            Media::create([
                'public_id' => $result->getPublicId(),
                'name' => $result->getFileName() . '.' . $result->getExtension(),
                'ext' => $result->getExtension(),
                'type' => $result->getFileType(),
                'alt' => $this->data['alt'],
                'title' => $this->data['title'],
                'description' => $this->data['description'],
                'width' => $result->getWidth(),
                'height' => $result->getHeight(),
                'disk' => env('MEDIA_DRIVER', 'local'),
                'size' => $result->getSize(),
            ]);
        }

        $this->form->fill([
            'file' => '',
            'alt' => '',
            'title' => '',
            'description' => '',
        ]);
    }

    public function render(): View
    {
        return view('livewire.add-media-to-library');
    }
}
