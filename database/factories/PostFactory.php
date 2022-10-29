<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $content = collect($this->faker->paragraphs())
          ->map(fn($p) => $p)
          ->implode("");
        return [
            "user_id" => rand(1, 30),
            "slug" => uniqid("post_"),
            "content" => $content,
        ];
    }
}
