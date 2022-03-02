<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;
use Trov\MediaLibrary\Models\Media;

class Image extends Component
{
    public $media;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->media = Media::where('id', $data['image'])->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.image');
    }
}
