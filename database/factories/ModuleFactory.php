<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition()
    {
        static $order = 1;

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'course_id' => Course::factory(),
            'order' => $order++

        ];
    }
}
