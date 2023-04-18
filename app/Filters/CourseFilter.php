<?php

namespace App\Filters;

use Closure;
use App\Data\Course\CourseFilterData;

class CourseFilter
{
    public function handle(CourseFilterData $data, Closure $next)
    {
        $builder = $data->builder;
        $filters = $data->filters;

        $builder->when($filters['q'] ?? null, function ($builder, $keyword) {
            $builder->where('name', 'REGEXP', $keyword)
                ->orWhere('code', 'REGEXP', $keyword);
        });

        return $next($data);
    }
}
