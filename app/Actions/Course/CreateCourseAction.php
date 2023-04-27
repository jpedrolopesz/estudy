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
                'thumbnail' => 'https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ]);


        return $course;
    }
}
