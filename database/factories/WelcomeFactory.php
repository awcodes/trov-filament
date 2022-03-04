<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Trov\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Welcome>
 */
class WelcomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $this->faker->sentence(4),
            'hero_image' => Media::inRandomOrder()->limit(1)->first(),
            'hero_content' => $this->faker->text,
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
            'has_chat' => $this->faker->boolean,
        ];
    }
}
