<?php

namespace App\Models;

use Trov\MediaLibrary\Models\Media;
use App\Models\Author;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;

class DiscoveryTopic extends Model
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
        'featured_image',
        'content',
        'seo_title',
        'seo_description',
        'indexable',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'indexable' => 'boolean',
        'published_at' => 'datetime',
        'content' => 'array',
    ];

    public function getPublicUrl()
    {
        return route('discovery-topics.show', $this);
    }

    public function articles()
    {
        return $this->hasMany(DiscoveryArticle::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(Media::class, 'id', 'featured_image');
    }
}
