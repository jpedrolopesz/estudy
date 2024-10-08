<?php

namespace App\Actions\Module;

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
