<?php

namespace Trov\MediaLibrary\Components\Forms;

use Filament\Forms;
use Livewire\Component;
use Trov\MediaLibrary\Models\Media;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateMediaForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Media $media;

    public $public_id;
    public $filename;
    public $ext;
    public $type;
    public $width;
    public $height;
    public $disk;
    public $size;
    public $upload;
    public $alt;
    public $title;
    public $caption;
    public $description;

    public function mount()
    {
        $this->form->fill();
    }

    protected function getFormModel(): string
    {
        return Media::class;
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Hidden::make('public_id'),
                    Forms\Components\Hidden::make('filename'),
                    Forms\Components\Hidden::make('ext'),
                    Forms\Components\Hidden::make('type'),
                    Forms\Components\Hidden::make('width'),
                    Forms\Components\Hidden::make('height'),
                    Forms\Components\Hidden::make('disk'),
                    Forms\Components\Hidden::make('size'),
                    Forms\Components\FileUpload::make('upload')
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
                ]),
            Forms\Components\TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            Forms\Components\TextInput::make('title'),
            Forms\Components\Textarea::make('caption')->rows(2),
            Forms\Components\Textarea::make('description')->rows(2),
        ];
    }

    public function create(): void
    {
        $media = Media::create($this->form->getState());
        $this->emit('setSelected', $media->id);
        $this->emit('insertNewFileItem', $media->id);
    }

    public function render()
    {
        return view('trov-media-library::forms.create-media-form');
    }
}
