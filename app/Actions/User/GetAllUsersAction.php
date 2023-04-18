<?php

namespace App\Actions\User;

use App\Data\User\UserFilterData;
use App\Filters\UserFilter;
use App\Models\User;
use Illuminate\Support\Facades\Pipeline;

class GetAllUsersAction
{
    public static function run(array $filters = [])
    {
        $data = UserFilterData::from([
            'builder' => User::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->through([
                UserFilter::class,
            ])
            ->then(fn ($data) => $data->builder)
            ->paginate(8)
            ->withQueryString();
    }
}
