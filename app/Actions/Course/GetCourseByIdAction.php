<?php

namespace App\Actions\Course;

use App\Models\Course;

class GetCourseByIdAction
{
    public static function run($id)
    {
        return Course::find($id);
    }
}
