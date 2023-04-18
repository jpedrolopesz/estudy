<?php

namespace App\Data\User;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

class UserFilterData extends Data
{
    public Builder $builder;

    public ?array $filters;
}
