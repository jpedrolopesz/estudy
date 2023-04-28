<?php

namespace App\Actions\Course;

use App\Data\Course\CreateCourseData;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CreateCourseAction
{
    public static function run(CreateCourseData $data)
    {

        $course = Course::create([
                'title' => $data->title,
                'description' => $data->description,
                'thumbnail' => $data->thumbnail[0],
            ]);




        return $course;
    }
}
