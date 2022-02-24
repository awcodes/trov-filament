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

class MediaLibraryModal extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Media $selected = null;
    public ?Media $newMedia = null;

    public $files = [];

    public function mount()
    {
        $this->createForm->fill();
        $this->editForm->fill();
        $this->fetchFiles();
    }

    public function fetchFiles()
    {
        $this->files = Media::orderBy('created_at', 'desc')->paginate(25)->toArray()['data'];
    }

    public function setSelected($mediaId = null)
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
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('caption')->rows(3),
            Textarea::make('description')->rows(3),
        ];
    }

    protected function getEditFormSchema(): array
    {
        return [
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('caption')->rows(3),
            Textarea::make('description')->rows(3),
        ];
    }

    public function handleEdit()
    {
        $this->selected->update($this->editForm->getState());
        Filament::notify('success', 'Saved');
    }

    public function handleCreate()
    {
        $newItem = Media::create($this->createForm->getState());

        Filament::notify('success', 'Saved');

        $this->editForm->fill([
            'alt' => $newItem->alt,
            'title' => $newItem->title,
            'description' => $newItem->description,
        ]);
    }

    public function destroyFile()
    {
        $this->selected->delete();
        $this->selected = null;
    }

    public function handleSelect()
    {
        dd('selected');
    }

    public function render()
    {
        return view('filament-media-library::media-library-modal');
    }
}
