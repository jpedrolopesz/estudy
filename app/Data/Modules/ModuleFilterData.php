<?php

namespace App\Data\Modules;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

class ModuleFilterData extends Data
{

    public Builder $builder;

    public ?array $filters;


}
