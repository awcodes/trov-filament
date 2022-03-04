<?php

namespace App\Models;

use App\Models\Author;
use App\Traits\IsSluggable;
use App\Traits\HasPublishedScope;
use Trov\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhitePage extends Model
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
        'type',
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
        return route('white-pages.show', ['type' => $this->type, 'page' => $this]) . '/';
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
