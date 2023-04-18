<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Models\User;
use App\Notifications\UserAddedToCourseNotification;

class ToggleCourseMembershipAction
{
    public static function run(Course $course, User $user)
    {
        if ($course->hasUser($user)) {
            $course->members()->detach($user->id);
        } else {
            $course->members()->attach($user->id);
            $user->notify(new UserAddedToCourseNotification($course));
        }
    }
}
