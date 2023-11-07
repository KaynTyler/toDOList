<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    public function definition(): array
    {

        return [
         'title' => $this->faker->sentence()  ,
         'description' => $this->faker->text(1000),
         'quote' => $this->faker->sentence() ,
        ];
    }
}
