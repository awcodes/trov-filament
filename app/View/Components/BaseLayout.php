<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseLayout extends Component
{
    public $meta;
    public $title;
    public $description;
    public $robots;
    public $ogImage;

    public function __construct($meta)
    {
        $this->title = isset($meta['title']) ? $meta['title'] . ' | ' . config('app.name') : config('app.name');
        $this->description = isset($meta['description']) ? $meta['description'] : config('app.description');
        $this->robots = isset($meta['robots']) ? $meta['robots'] : 'index,follow';
        $this->ogImage = isset($meta['ogImage']) ? $meta['ogImage'] : null;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.base', [
            'title' => $this->title,
            'description' => $this->description,
            'robots' => $this->robots,
        ]);
    }
}
