<?php

namespace App\Data\Course;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

class CourseFilterData extends Data
{

    public Builder $builder;

    public ?array $filters;


}
