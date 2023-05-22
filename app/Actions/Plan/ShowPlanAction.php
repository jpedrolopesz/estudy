<?php

namespace App\Actions\Plan;


use App\Models\Plan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class ShowPlanAction
{
    public function execute(int $id):array|Builder|Collection|Model
    {
        return Plan::with('planFeatures')
            ->orderBy('price')
            ->get();
    }
}


