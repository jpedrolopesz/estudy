<?php

namespace App\Actions\User;

use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Facades\Request;
use App\Data\User\UserFilterData;
use App\Models\User;


class GetAllUsersAction
{
    public static function run(array $filters = [])
    {
        $data = UserFilterData::from([
            'builder' => User::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->then(fn ($data) => $data->builder)
            ->filter(Request::only('search', 'trashed', 'role'))
            ->paginate(7)
            ->withQueryString();
    }
}
