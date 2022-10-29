<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
     
    public function definition()
    {
        return [
            "post_id" => 1,
            "user_id" => rand(2, 30),
            "like" => true
        ];
    }
}
