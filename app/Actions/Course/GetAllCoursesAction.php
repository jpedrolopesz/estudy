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
            ->through([
                CourseFilter::class,
            ])
            ->then(fn($data) => $data->builder)
            ->with(['owner', 'members'])
            ->paginate(8)
            ->withQueryString();
    }

}
