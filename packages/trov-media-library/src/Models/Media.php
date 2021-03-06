<?php

namespace Trov\MediaLibrary\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Trov\MediaLibrary\Traits\HasCloudinaryUrls;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasCloudinaryUrls;
    use HasFactory;

    protected $fillable = [
        'public_id',
        'filename',
        'ext',
        'type',
        'alt',
        'title',
        'description',
        'caption',
        'width',
        'height',
        'disk',
        'size',
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
    ];

    protected $appends = [
        'url',
        'large',
        'medium',
        'thumb',
    ];

    public function sizeForHumans()
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $this->size > 1024; $i++) {
            $this->size /= 1024;
        }

        return round($this->size, 1) . ' ' . $units[$i];
    }
}
