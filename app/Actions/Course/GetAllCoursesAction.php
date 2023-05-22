<?php

namespace App\Actions\Course;

use App\Data\Course\CourseFilterData;
use App\Filters\CourseFilter;
use App\Models\Course;
use Illuminate\Support\Facades\Pipeline;

class GetAllCoursesAction
{

    public static function run(array $filters = [])
    {
        $data = CourseFilterData::from([
            'builder' => Course::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->then(fn($data) => $data->builder)
            ->filter(\Illuminate\Support\Facades\Request::only('search', 'role', 'trashed'))
            ->paginate(4)
            ->withQueryString();
    }

}
