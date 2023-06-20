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
    public function execute(int $id): array|Builder|Collection|Model
    {
        $user = Auth::user();

        if (!$user->subscribed('default')) {
            return Course::with(['modules' => function ($query) use ($user) {
                $query->orderBy('sort_order')->with(['lessons' => function ($query) use ($user) {
                    $query->orderBy('sort_order')
                        ->with(['comments' => function ($query) use ($user) {
                            $query->with('user','replies');
                        }])
                        ->with(['lessonUserViews' => function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        }]);
                }]);
            }])->findOrFail($id);

        }

        return [];
    }


}


