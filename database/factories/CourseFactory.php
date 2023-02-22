<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'thumbnail' => fake()->imageUrl($width=400, $height=400),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'user_id' => 1
        ];
    }
}
