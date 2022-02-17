<?php

namespace App\Traits;

use Illuminate\Contracts\View\View;

trait HasMediaLibrary
{
    protected function getFooter(): ?View
    {
        parent::getFooter();
        return view('media-library');
    }
}
