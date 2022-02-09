<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Author;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $handle = $this->faker->userName;

        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'bio' => $this->faker->text,
            'facebook_handle' => $handle,
            'twitter_handle' => $handle,
            'instagram_handle' => $handle,
            'linkedin_handle' => $handle,
            'youtube_handle' => $handle,
            'pinterest_handle' => $handle,
            'avatar' => null,
        ];
    }
}
