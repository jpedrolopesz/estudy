<?php

namespace App\Actions\User;


use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShowSubscribedCourseAction
{
    public function execute(int $id): array
    {
        $user = Auth::user();

        if ($user && !$user->subscribed('default')) {
            $course = Course::with(['modules' => function ($query) use ($user) {
                $query->orderBy('sort_order')->with(['lessons' => function ($query) use ($user) {
                    $query->orderBy('sort_order')
                        ->with(['comments' => function ($query) use ($user) {
                            $query->with(['user', 'replies' => function ($query) use ($user) {
                                $query->with('user')->where('user_id', $user->id);
                            }]);
                        }])
                        ->with(['lessonUserViews' => function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        }]);
                }]);
            }])->findOrFail($id);

            $totalLessons = $course->modules->sum(function ($module) {
                return $module->lessons->count();
            });

            $watchedLessons = $course->modules->sum(function ($module) use ($user) {
                return $module->lessons->sum(function ($lesson) use ($user) {
                    return $lesson->lessonUserViews->where('user_id', $user->id)->where('watched', true)->count();
                });
            });

            $progressPercentage = 0;
            if ($totalLessons > 0) {
                $progressPercentage = ($watchedLessons / $totalLessons) * 100;
            }


            return [
                'course' => $course,
                'progressPercentage' => $progressPercentage,

            ];
        }

        return [];
    }


}


