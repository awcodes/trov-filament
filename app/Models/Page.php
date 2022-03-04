<?php

namespace App\Models;

use App\Traits\IsSluggable;
use App\Traits\HasPublishedScope;
use Trov\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use HasPublishedScope;
    use IsSluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
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
        return route('pages.show', $this) . '/';
    }

    public function heroImage()
    {
        return $this->hasOne(Media::class, 'id', 'hero_image');
    }
}
