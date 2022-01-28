<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Author extends Model implements HasAvatar
{
    use HasFactory;
    use HasSlug;

    protected static function booted()
    {
        static::updating(function ($author) {
            $oldSlug = $author->getOriginal()['slug'];
            $newSlug = $author->getAttributes()['slug'];

            if ($oldSlug !== $newSlug) {
                $author->generateSlug();
            }
        });

        static::deleting(function ($author) {
            if ($author->avatar) {
                Storage::delete($author->avatar);
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

    public function getFilamentAvatarUrl(): ?string
    {
        // $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
        //     return $segment[0] ?? '';
        // })->join(' '));

        // return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=1e40af&background=bfdbfe';
        return '/default-avatar.jpg';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'bio',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'pinterest',
        'avatar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function getAvatarAttribute($value)
    {
        return $value ? $value : $this->getFilamentAvatarUrl();
    }
}
