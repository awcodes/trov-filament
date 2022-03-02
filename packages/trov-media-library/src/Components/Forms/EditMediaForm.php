<?php

namespace Trov\MediaLibrary\Components\Forms;

use Trov\MediaLibrary\Models\Media;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class EditMediaForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Media $media;

    public $alt;
    public $title;
    public $caption;
    public $description;

    public function mount($file)
    {
        $this->media = Media::where('id', $file['id'])->first();

        $this->form->fill([
            'alt' => $this->media['alt'],
            'title' => $this->media['title'],
            'caption' => $this->media['caption'],
            'description' => $this->media['description'],
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('alt')->label('Alt Text')->helperText('<a href="https://www.w3.org/WAI/tutorials/images/decision-tree/" class="underline" target="_blank">Learn how to describe the purpose of the image</a>. Leave empty if the image is purely decorative.'),
            TextInput::make('title'),
            Textarea::make('caption')->rows(2),
            Textarea::make('description')->rows(2),
        ];
    }

    public function update(): void
    {
        $this->media->update($this->form->getState());
    }

    public function destroy(): void
    {
        $this->form->fill();
        $this->emit('setSelected');
        $this->emit('removeFileItem', $this->media->id);
        $this->media->delete();
    }

    public function render()
    {
        return view('trov-media-library::forms.edit-media-form');
    }
}
