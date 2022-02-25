<?php

namespace Trov\MediaLibrary\Traits;

use App\Helpers;
use Trov\MediaLibrary\Models\Media;

trait HasCloudinaryUrls
{
    public function cloudinary(Media $media, $transforms = 'f_auto,q_auto')
    {
        return 'https://res.cloudinary.com/' . config('cloudinary.cloud_name') . '/image/upload/' . $transforms . '/' . $media->public_id . '.' . $media->ext;
    }

    public function getUrlAttribute()
    {
        return $this->cloudinary($this);
    }

    public function getLargeAttribute()
    {
        return $this->cloudinary($this, 'f_auto,q_auto,w_1024,c_fill');
    }

    public function getMediumAttribute()
    {
        return $this->cloudinary($this, 'f_auto,q_auto,w_640,c_fill');
    }

    public function getThumbAttribute()
    {
        return $this->cloudinary($this, 'f_auto,q_auto,w_150,h_150,c_fill,g_face');
    }
}
