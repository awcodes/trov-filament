<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\HasSlug;
use App\Traits\HasPublishedScope;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;
    use HasTags;
    use HasSlug;
    use HasPublishedScope;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('question')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'slug',
        'status',
        'answer',
        'seo_title',
        'seo_description',
    ];

    public function getPublicUrl()
    {
        return route('faqs.show', $this) . '/';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
