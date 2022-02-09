<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Indicate that the page is in review status.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inReview()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'review',
            ];
        });
    }

    /**
     * Indicate that the page is in published status.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $post = "<h2>{$title}</h2>";
        foreach ($paragraphs as $para) {
            $post .= "<p>{$para}</p>";
        }

        return [
            'title' => $this->faker->sentence(4),
            'slug' => Str::slug($title),
            'status' => 'draft',
            'hero_image' => $this->faker->image(storage_path('app/public/images'), 1024, 576, 'nature', false, true, null),
            'hero_content' => $this->faker->text,
            'content' => null,
            'seo_title' => $this->faker->word,
            'seo_description' => $this->faker->text,
            'indexable' => $this->faker->boolean,
            'has_chat' => $this->faker->boolean,
        ];
    }
}
