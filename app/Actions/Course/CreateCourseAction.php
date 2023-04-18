<?php

namespace App\Actions\Course;

use App\Data\Course\CreateCourseData;
use Illuminate\Support\Facades\Auth;

class CreateCourseAction
{
    public static function run(CreateCourseData $data)
    {
        $course = Auth::user()
            ->ownedCourses()
            ->create([
                'title' => $data->title,
                'description' => $data->description,
                'thumbnail' => $data->thumbnail,
            ]);

        $course->members()->sync($data->members);

        return $course;
    }
}
