<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $text = fake()->text(2000);
        return [
            'title' => fake()->words(5, true),
            'seo_title' => fake()->words(6, true),
            'seo_description' => fake()->words(15, true),
            'seo_keywords' => str_replace(' ', ', ', fake()->words(15, true)),
            'text' => $text,
            'text_striped' => $text,
            'description' => fake()->words(20, true),
            'top' => rand(0,1),
        ];
    }
}
