<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlockContent extends Component
{
    public $blocks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.block-content');
    }
}
