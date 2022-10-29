<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          "user_id" => rand(1, 30),
          "post_id" => rand(1, 30),
          "comment" => $this->faker->paragraph(),
            
        ];
    }
}
