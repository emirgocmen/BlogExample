<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         =>  $this->faker->unique()->sentence(rand(2,5)),
            'detail'        =>  $this->faker->paragraph(rand(5,15)),
            'image'         =>  'https://picsum.photos/2000',
            'category_id'   =>  rand(1,10),
            'status'        =>  (string)rand(0,1),
            'created_by'    =>  rand(1,10),
        ];
    }
}
