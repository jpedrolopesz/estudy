<?php

namespace App\Data\Plan;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

class PlanFilterData extends Data
{

    public Builder $builder;

    public ?array $filters;


}
