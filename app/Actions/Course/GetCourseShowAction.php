<?php

namespace App\Actions\Course;


use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class GetCourseShowAction
{
    public function execute(int $id):array|Builder|Collection|Model
    {
        return Course::with(['modules' => function ($query) {
            $query->orderBy('sort_order')->with(['lessons' => function ($query) {
                $query->orderBy('sort_order');
            }]);
        }])->findOrFail($id);

    }
}


