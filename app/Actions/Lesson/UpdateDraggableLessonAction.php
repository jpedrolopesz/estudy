<?php

namespace App\Actions\Lesson;

use App\Models\Lesson;

class UpdateDraggableLessonAction
{
    public static function run(array $payload)
    {
        foreach ($payload as $lesson) {
            Lesson::findOrFail($lesson['id'])
                ->update([
                    'sort_order' => $lesson['sort_order'],
                ]);
        }
    }
}
