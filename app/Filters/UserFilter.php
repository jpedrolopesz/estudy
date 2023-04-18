<?php

namespace App\Filters;

use App\Data\User\UserFilterData;
use Closure;

class UserFilter
{
    public function handle(UserFilterData $data, Closure $next)
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
