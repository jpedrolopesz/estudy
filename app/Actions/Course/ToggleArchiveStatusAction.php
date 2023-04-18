<?php

namespace App\Actions\Course;

use App\Models\Course;

class ToggleArchiveStatusAction
{
    public static function run(Course $course)
    {
        return tap($course)->update([
            'archived_at' => $course->isArchived() ? null : now(),
        ]);
    }
}
