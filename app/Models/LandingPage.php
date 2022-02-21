<?php

namespace App\Models;

use App\Traits\HasCloudinaryUrls;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;

class LandingPage extends Model
{
    use HasFactory;
    use HasCloudinaryUrls;
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
        return route('landing-pages.show', $this);
    }
}
