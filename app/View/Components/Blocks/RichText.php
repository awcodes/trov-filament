<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;
use Mews\Purifier\Facades\Purifier;

class RichText extends Component
{
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->content = Purifier::clean($data['content']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.rich-text');
    }
}
