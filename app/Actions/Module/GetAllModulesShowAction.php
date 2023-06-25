<?php

namespace App\Actions\Module;


use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetAllModulesShowAction
{


    public function execute(int $id):array|Builder|Collection|Model
    {
        return Lesson::where('module_id', $id)->get();
    }


}
