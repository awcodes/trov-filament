<?php

namespace App\Models;

use App\Models\Author;
use App\Traits\IsSluggable;
use App\Models\DiscoveryTopic;
use App\Traits\HasPublishedScope;
use Trov\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscoveryArticle extends Model
{
    use HasPublishedScope;
    use IsSluggable;
    use HasFactory;

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

    public function getPublicUrl()
    {
        return route('discovery-articles.show', $this) . '/';
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
