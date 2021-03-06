<?php

namespace Database\Factories;

use App\Models\Post;
use Trov\MediaLibrary\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

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
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => 'draft',
            'author_id' => rand(1, 5),
            'featured_image' => Media::inRandomOrder()->limit(1)->first(),
            'content' => [
                [
                    'full_width' => false,
                    'bg_color' => '',
                    'blocks' => [
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
                                "content" => '<p>' . collect($this->faker->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p>',
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
                                "content" => '<p>' . collect($this->faker->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p>',
                            ]
                        ],
                    ],
                ],
            ],
            'seo_title' => Str::title($this->faker->words(rand(2, 6), true)),
            'seo_description' => $this->faker->text,
            'indexable' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
