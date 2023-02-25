<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'title' => $this->faker->sentence,
            'comment' => $this->faker->paragraphs($this->faker->numberBetween(0, 5), true)
        ];
    }
}
