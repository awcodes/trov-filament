<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\LandingPage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandingPageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LandingPage::class;

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

        return [
            'title' => $this->faker->sentence(4),
            'slug' => Str::slug($title),
            'status' => 'draft',
            'content' => [
                [
                    "type" => "heading",
                    "data" => [
                        "content" => Str::title($this->faker->words(rand(3, 8), true)),
                        "level" => "h1"
                    ]
                ],
                [
                    "type" => "rich-text",
                    "data" => [
                        "content" => $this->faker->paragraphs(rand(2, 5), true)
                    ]
                ],
                [
                    "type" => "heading",
                    "data" => [
                        "content" => Str::title($this->faker->words(rand(3, 8), true)),
                        "level" => "h2"
                    ]
                ],
                [
                    "type" => "rich-text",
                    "data" => [
                        "content" => $this->faker->paragraphs(rand(2, 5), true)
                    ]
                ]
            ],
            'seo_title' => Str::title($this->faker->words(rand(2, 6), true)),
            'seo_description' => $this->faker->text,
            'indexable' => $this->faker->boolean,
            'has_chat' => $this->faker->boolean,
        ];
    }
}
