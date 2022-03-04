<?php

namespace Trov\MediaLibrary\Components\Modal;

use Livewire\Component;
use Trov\MediaLibrary\Models\Media;

class MediaLibrary extends Component
{
    public array $selected = [];
    public array $files = [];
    public int $offset = 0;
    public int $limit = 25;

    protected $listeners = ['setSelected', 'removeFileItem', 'insertNewFileItem'];

    public function mount()
    {
        $this->getFiles();
    }

    public function setSelected($mediaId = null): void
    {
        if (!$mediaId) {
            $this->selected = [];
        } elseif ($this->selected && $this->selected['id'] === $mediaId) {
            $this->selected = [];
        } else {
            $this->selected = Media::where('id', $mediaId)->first()->toArray();
        }
    }

    public function getFiles(): void
    {
        $oldFiles = $this->files;
        $newFiles = Media::orderBy('created_at', 'desc')->take($this->limit)->offset($this->offset)->get()->toArray();
        $this->files = array_merge($oldFiles, $newFiles);
        $this->offset = $this->offset + $this->limit;
    }

    public function removeFileItem($mediaId = null): void
    {
        $this->files = collect($this->files)->filter(function ($item) use ($mediaId) {
            return $item['id'] !== $mediaId;
        })->toArray();
    }

    public function insertNewFileItem($mediaId = null): void
    {
        $media = Media::where('id', $mediaId)->first();
        $this->files = collect($this->files)->prepend($media)->toArray();
    }

    public function render()
    {
        return view('trov-media-library::modal.media-library');
    }
}
