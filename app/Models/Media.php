<?php

namespace App\Models;

use App\Helpers;
use App\Traits\HasCloudinaryUrls;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    use HasCloudinaryUrls;

    protected $fillable = [
        'public_id',
        'name',
        'ext',
        'type',
        'alt',
        'title',
        'description',
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
}
