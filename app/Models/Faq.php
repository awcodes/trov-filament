<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;
    use HasTags;

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
        'question',
        'slug',
        'status',
        'answer',
        'seo_title',
        'seo_description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
