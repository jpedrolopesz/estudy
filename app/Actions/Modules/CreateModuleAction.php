<?php

namespace App\Actions\Modules;

use App\Http\Requests\Course\CreateModuleRequest;
use App\Models\Module;
use Illuminate\Http\Request;

class CreateModuleAction
{
    public static function run(Request $request)
    {


        $module = Module::create([
            'course_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $module;
    }
}
