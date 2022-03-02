<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class Heading extends Component
{
    public $level;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->level = $data['level'];
        $this->content = $data['content'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.heading');
    }
}
