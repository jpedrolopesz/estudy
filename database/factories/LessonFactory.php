<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'video_url' => 'https://www.youtube.com/embed/MlgbDr-9SJE',
        ];
    }
}
