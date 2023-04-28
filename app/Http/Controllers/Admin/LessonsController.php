<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Modules\CreateModuleAction;
use App\Actions\Modules\GetAllModulesShowAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateModuleRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonsController extends Controller
{
    public function show($module_id)
    {

        $lessons = Lesson::where('module_id', $module_id)->get();

        return Inertia::render('Admin/Course/Lessons/Create', [
            'lessons' => $lessons,
        ]);


    }

    public function store(Request $request, Course $course, Module $module)
    {
        $lesson = new Lesson($request->all());
        $lesson->module_id = $module->id;
        $lesson->save();

        return redirect()->route('modules.show', [$course, $module]);
    }



    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
