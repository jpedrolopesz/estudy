<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Models\User;
use App\Notifications\UserHasBeenMadeCourseAdminNotification;

class ToggleAdminStatusAction
{
    public static function run(Course $course, User $user)
    {
        if ($user->isCourseOwner($course)) {
            return;
        }
        $isCourseAdmin = $user->isCourseAdmin($course);
        $course->members()->updateExistingPivot($user->id, [
            'is_admin' => !$isCourseAdmin,
        ]);
        if (!$isCourseAdmin) {
            $user->notify(new UserHasBeenMadeCourseAdminNotification($course));
        }
    }
}
