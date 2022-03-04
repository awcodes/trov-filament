<?php

namespace App\Models;

use App\Traits\IsSluggable;
use App\Traits\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingPage extends Model
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
        'content',
        'seo_title',
        'seo_description',
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
        return route('landing-pages.show', $this) . '/';
    }
}
