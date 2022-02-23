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
        $this->files = Media::orderBy('created_at', 'desc')->paginate(25)->toArray()['data'];
    }

    protected function getForms(): array
    {
        return [
            'createForm' => $this->makeForm()
                ->schema($this->getCreateFormSchema())
                ->model($this->newMedia)
                ->statePath('createData'),
            'editForm' => $this->makeForm()
                ->schema($this->getEditFormSchema())
                ->model($this->selected)
                ->statePath('editData'),
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
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('description')->rows(3),
        ];
    }

    protected function getEditFormSchema(): array
    {
        return [
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('description')->rows(3),
        ];
    }

    public function getMediaItem($mediaId = null)
    {
        if ($this->selected && $this->selected->id === $mediaId) {
            $this->selected = null;
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

        foreach ($this->createData['file'] as $file) {
            $originalName = $file->getClientOriginalName();
            $basename = pathinfo($originalName, PATHINFO_FILENAME);
            $result = $file->storeOnCloudinaryAs(env('CLOUDINARY_FOLDER'), $basename);

            $this->selected = Media::create([
                'public_id' => $result->getPublicId(),
                'name' => $result->getFileName() . '.' . $result->getExtension(),
                'ext' => $result->getExtension(),
                'type' => $result->getFileType(),
                'alt' => $this->createData['alt'],
                'title' => $this->createData['title'],
                'description' => $this->createData['description'],
                'width' => $result->getWidth(),
                'height' => $result->getHeight(),
                'disk' => env('MEDIA_DRIVER', 'local'),
                'size' => $result->getSize(),
            ]);
        }

        Filament::notify('success', 'Saved');

        $this->fetchFiles();

        $this->editForm->fill([
            'alt' => $this->selected->alt,
            'title' => $this->selected->title,
            'description' => $this->selected->description,
        ]);
    }

    public function destroyFile()
    {
        $this->selected->delete();
        $this->selected = null;
        $this->fetchFiles();
    }

    public function clearSelected()
    {
        $this->selected = null;
    }

    public function render()
    {
        return view('livewire.media-library');
    }
}
