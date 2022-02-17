<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'alt_text',
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
        'thumb',
    ];

    public function getUrlAttribute()
    {
        return Helpers::cloudinary($this->file_name);
    }

    public function getThumbAttribute()
    {
        return Helpers::cloudinary($this->file_name, 'f_auto,q_auto,w_150,h_150,c_crop');
    }
}
