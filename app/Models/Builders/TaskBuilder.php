<?php

namespace App\Models\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait TaskBuilder
{
    public function scopeResolved(Builder $builder)
    {
        return $builder->whereNotNull('resolved_at');
    }

    public function scopeOpen(Builder $builder)
    {
        $builder->whereNull('resolved_at');
    }

    public function scopeWhereDateBetween(Builder $builder, $fieldName, $fromDate, $todate)
    {
        $builder->whereDate($fieldName, '>=', $fromDate)
            ->whereDate($fieldName, '<=', $todate);
    }

    public function scopeOrderByCode(Builder $builder, string $field, string $dir = 'desc')
    {
        $builder->orderBy(
            Code::select('display')->whereColumn('codes.id', "tasks.{$field}"),
            $dir
        );
    }

    public function scopeOrderByUser(Builder $builder, string $field, string $dir = 'desc')
    {
        $builder->orderBy(
            User::select('name')->whereColumn('users.id', "tasks.{$field}_id"),
            $dir
        );
    }
}
