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
    public function create($module_id)
    {
        $module = Module::find($module_id);


        return Inertia::render('Admin/Course/Lessons/Create', [
            'module' => $module,
        ]);


    }

    public function store(Request $request, Course $course, Module $module)
    {
        dd($request->all());
        $lesson = Lesson::find(1);
        $pathToFile = $request->file('media')->store('media');

        $lesson
            ->addMedia($pathToFile)
            ->toMediaCollection();
        return redirect()->route('modules.show', [$course, $module]);
    }

    public function edit($module_id)
    {

        $module = Lesson::where('module_id', $module_id)->get();

        return Inertia::render('Admin/Course/Lessons/Create', [
            'module' => $module,
        ]);


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
