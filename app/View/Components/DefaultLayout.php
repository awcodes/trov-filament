<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DefaultLayout extends Component
{
    public $meta;
    public $title;
    public $description;
    public $robots;

    public function __construct($meta)
    {
        $this->title = isset($meta['title']) ? $meta['title'] . ' | ' . config('app.name') : config('app.name');
        $this->description = isset($meta['description']) ? $meta['description'] : config('app.description');
        $this->robots = isset($meta['robots']) ? $meta['robots'] : 'index,follow';
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.default', [
            'title' => $this->title,
            'description' => $this->description,
            'robots' => $this->robots,
        ]);
    }
}
