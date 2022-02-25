<?php

namespace Trov\MediaLibrary\Traits;

use App\Helpers;

trait HasCloudinaryUrls
{
    public function getUrlAttribute()
    {
        return Helpers::cloudinary($this);
    }

    public function getLargeAttribute()
    {
        return Helpers::cloudinary($this, 'f_auto,q_auto,w_1024,c_fill');
    }

    public function getMediumAttribute()
    {
        return Helpers::cloudinary($this, 'f_auto,q_auto,w_640,c_fill');
    }

    public function getThumbAttribute()
    {
        return Helpers::cloudinary($this, 'f_auto,q_auto,w_150,h_150,c_fill,g_face');
    }
}
