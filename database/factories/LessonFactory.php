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
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'video_url' => '/videos/curso_introducao.mp4',
        ];
    }
}
