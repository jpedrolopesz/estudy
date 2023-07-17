<?php

namespace App\Actions\Plan;

use App\Models\Plan;
use App\Data\Plan\PlanFilterData;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Pipeline;
use NumberFormatter;

class GetAllPlansAction
{
    public static function run(array $filters = [])
    {
        $data = PlanFilterData::from([
            'builder' => Plan::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->then(fn ($data) => $data->builder)
            ->filter(Request::only('search', 'trashed'))
            ->paginate(6)
            ->withQueryString();

    }
}
