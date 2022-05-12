<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    =>  ucfirst($this->faker->unique()->word()),
            'status'  =>  (string)rand(0,1),
            'pid'     =>  null,
        ];
    }
}
