<?php

namespace App\Actions\Course;

use App\Data\Course\UpdateCourseData;
use App\Models\Course;
use App\Models\User;
use App\Notifications\UserAddedToCourseNotification;

class UpdateCourseAction
{
    public static function run(UpdateCourseData $data, Course $course)
    {
        $course->update([
            'name' => $data->name ?? $course->name,
            'description' => $data->description ?? $course->description,
            'color' => $data->color ?? $course->color,
            'icon' => $data->icon ?? $course->icon,
            'start_date' => $data->start_date ?? $course->start_date,
            'due_date' => $data->due_date ?? $course->due_date,
        ]);

        if ($data->members) {
            $current_members = $course->members->pluck('id');
            $new_members = collect($data->members)->diff($current_members);

            $course->members()->sync($data->members);

            if (!$new_members->isEmpty()) {
                foreach (User::findMany($new_members->toArray()) as $user) {
                    $user->notify(new UserAddedToCourseNotification($course));
                }
            }

        }

    }
}
