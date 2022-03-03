<?php

namespace App\Models;

use Trov\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Welcome extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'hero_image',
        'hero_content',
        'content',
        'seo_title',
        'seo_description',
        'indexable',
        'has_chat',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'indexable' => 'boolean',
        'has_chat' => 'boolean',
        'content' => 'array',
    ];

    public function getPublicUrl()
    {
        return route('welcome', $this);
    }

    public function heroImage()
    {
        return $this->hasOne(Media::class, 'id', 'hero_image');
    }
}
