<?php

namespace App\Models;

use App\Models\Media;
use App\Models\Author;
use App\Models\DiscoveryTopic;
use App\Traits\HasCloudinaryUrls;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscoveryArticle extends Model
{
    use HasFactory;
    use HasCloudinaryUrls;

    protected static function booted()
    {
        static::updating(function ($page) {
            $oldSlug = $page->getOriginal()['slug'];
            $newSlug = $page->getAttributes()['slug'];

            if ($oldSlug !== $newSlug) {
                $page->generateSlug();
            }
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
        'author_id',
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

    public function getFeaturedImageDataAttribute()
    {
        $imageData = Storage::disk('images')->path($this->featured_image);
        $size = getimagesize($imageData);

        return [
            'url' => Storage::disk('images')->url($this->featured_image),
            'alt' => $this->featured_image_alt,
            'width' => $size[0],
            'height' => $size[1],
        ];
    }

    public function getPublicUrl()
    {
        return route('discovery-articles.show', $this);
    }

    public function topic()
    {
        return $this->belongsTo(DiscoveryTopic::class, 'discovery_topic_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(Media::class, 'id', 'featured_image');
    }
}
