<?php

namespace Trov\MediaLibrary\Components\Forms;

use Trov\MediaLibrary\Models\Media;
use Livewire\Component;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
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
            Group::make()
                ->schema([
                    Hidden::make('public_id'),
                    Hidden::make('filename'),
                    Hidden::make('ext'),
                    Hidden::make('type'),
                    Hidden::make('width'),
                    Hidden::make('height'),
                    Hidden::make('disk'),
                    Hidden::make('size'),
                    FileUpload::make('upload')
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
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('caption')->rows(3),
            Textarea::make('description')->rows(3),
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
