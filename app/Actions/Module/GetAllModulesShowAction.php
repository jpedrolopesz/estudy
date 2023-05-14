<?php

namespace App\Actions\Module;

use App\Data\Course\CourseFilterData;
use App\Filters\CourseFilter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Pipeline;

class GetAllModulesShowAction
{


    public function execute(int $id):array|Builder|Collection|Model
    {
        return Lesson::where('module_id', $id)->get();
    }


}
