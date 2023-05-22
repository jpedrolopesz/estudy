<?php

namespace App\Filters;

use App\Data\Plan\PlanFilterData;
use Closure;

class PlanFilter
{
    public function handle(PlanFilterData $data, Closure $next)
    {
        $builder = $data->builder;
        $filters = $data->filters;

        $builder->when($filters['q'] ?? null, function ($builder, $keyword) {
            $builder->where('first_name', 'REGEXP', $keyword)
                ->orWhere('last_name', 'REGEXP', $keyword)
                ->orWhere('email', 'REGEXP', $keyword);
        });

        return $next($data);
    }
}
