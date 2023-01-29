<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title' => $this->faker->sentence(5),
           'user_id' => 1003,
           'description' => $this->faker->paragraph(4),
           'content' => $this->faker->text(300),
           'image' => 'images/blogs/img2.png',
           'status' => '1',
        ];
    }
}
