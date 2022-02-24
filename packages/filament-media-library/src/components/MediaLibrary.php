<?php

namespace AWCodes\FilamentMediaLibrary\Components;

use App\Models\Media;
use Filament\Forms\Components\Field;

class MediaLibrary extends Field
{
    protected string $view = 'filament-media-library::media-library';

    protected array | Closure $files = [];

    public $selected = null;
    public $offset = 0;
    public $limit = 10;

    public function setSelected($mediaId)
    {
        if ($this->selected && $this->selected['id'] === $mediaId) {
            $this->selected = null;
        } else {
            $media = Media::where('id', $mediaId)->first()->toArray();
            $this->selected = $media ?: null;
        }
    }
}
