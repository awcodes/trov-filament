<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Trov\MediaLibrary\Models\Media;

class Page extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

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
