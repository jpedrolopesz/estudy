<?php

namespace App\Data\Comment;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

class CommentFilterData extends Data
{

    public Builder $builder;

    public ?array $filters;


}
