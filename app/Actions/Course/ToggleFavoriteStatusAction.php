<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Models\User;

class ToggleFavoriteStatusAction
{
    public static function run(Course $course, User $user)
    {
        $course->members()->updateExistingPivot($user->id, [
            'is_favorite' => ! $user->hasFavedCourse($course),
        ]);
    }
}
