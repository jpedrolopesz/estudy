<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {


        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'module_id' => Module::factory(),
            'order' => $this->faker->numberBetween(1, 10),
            'video_url' => 'https://www.youtube.com/embed/MlgbDr-9SJE',
           // 'file_path' => $this->faker->file('storage/app/public', true),
        ];
    }
}
