<?php

namespace App\Models;

use App\Models\Post;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
                Storage::disk('avatars')->delete($author->avatar);
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
        return 'default-avatar.jpg';
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
