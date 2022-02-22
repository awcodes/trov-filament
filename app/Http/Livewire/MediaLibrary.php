<?php

namespace App\Http\Livewire;

use App\Models\Media;
use Filament\Facades\Filament;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class MediaLibrary extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Media $selected = null;
    public ?Media $newMedia = null;

    public $files = [];

    public function mount()
    {
        $this->fetchFiles();

        $this->createForm->fill([
            'file' => '',
            'alt' => '',
            'title' => '',
            'description' => '',
        ]);

        $this->editForm->fill([
            'alt' => '',
            'title' => '',
            'description' => '',
        ]);
    }

    public function fetchFiles()
    {
        $this->files = Media::paginate(25)->toArray()['data'];
    }

    protected function getForms(): array
    {
        return [
            'createForm' => $this->makeForm()
                ->schema($this->getCreateFormSchema())
                ->model($this->newMedia),
            'editForm' => $this->makeForm()
                ->schema($this->getEditFormSchema())
                ->model($this->selected),
        ];
    }

    protected function getCreateFormSchema(): array
    {
        return [
            FileUpload::make('file')
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

    protected function getEditFormSchema(): array
    {
        return [
            TextInput::make('alt')->helperText('Describe this image. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('description')->rows(3),
        ];
    }

    public function getMediaItem($mediaId = null)
    {
        if ($this->selected && $this->selected['id'] === $mediaId) {
            $this->selected = [];
        } else {
            $this->selected = Media::where('id', $mediaId)->first();

            $this->editForm->fill([
                'alt' => $this->selected ? $this->selected->alt : '',
                'title' => $this->selected ? $this->selected->title : '',
                'description' => $this->selected ? $this->selected->description : '',
            ]);
        }
    }

    public function handleEdit()
    {
        $this->selected->update($this->editForm->getState());
        Filament::notify('success', 'Saved');
    }

    public function handleCreate()
    {
        $this->validate();

        $data = $this->createForm->getState();

        $originalName = $data['file']->getClientOriginalName();
        $basename = pathinfo($originalName, PATHINFO_FILENAME);
        $result = $data['file']->storeOnCloudinaryAs(env('CLOUDINARY_FOLDER'), $basename);


        // $this->selected = Media::create([
        //     'public_id' => $result->getPublicId(),
        //     'name' => $result->getFileName() . '.' . $result->getExtension(),
        //     'ext' => $result->getExtension(),
        //     'type' => $result->getFileType(),
        //     'alt' => $this->data['alt'],
        //     'title' => $this->data['title'],
        //     'description' => $this->data['description'],
        //     'width' => $result->getWidth(),
        //     'height' => $result->getHeight(),
        //     'disk' => env('MEDIA_DRIVER', 'local'),
        //     'size' => $result->getSize(),
        // ]);

        // Filament::notify('success', 'Saved');
    }

    public function render()
    {
        return view('livewire.media-library');
    }
}
