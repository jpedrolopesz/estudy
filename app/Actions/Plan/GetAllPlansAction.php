<?php

namespace App\Actions\Plan;

use App\Data\Plan\PlanFilterData;
use App\Filters\PlanFilter;
use Illuminate\Support\Facades\Pipeline;
use App\Models\Plan;

class GetAllPlansAction
{
    public static function run(array $filters = [])
    {
        $data = PlanFilterData::from([
            'builder' => Plan::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->through([
                PlanFilter::class,
            ])

            ->then(fn ($data) => $data->builder)
            ->filter(\Illuminate\Support\Facades\Request::only('search', 'role', 'trashed'))
            ->paginate(8)
            ->withQueryString();
    }
}
