<?php

namespace App\Actions\Course;

use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Facades\Request;
use App\Data\Course\CourseFilterData;
use App\Models\Course;



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
            ->filter(Request::only('search', 'trashed'))
            ->paginate(4)
            ->withQueryString();
    }

}
