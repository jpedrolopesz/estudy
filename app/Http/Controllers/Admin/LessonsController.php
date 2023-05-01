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
    public function create($course_id,$module_id)
    {
        $course = Course::find($course_id);
        $module = Module::find($module_id);


        return Inertia::render('Admin/Course/Lessons/Create', [
            'module' => $module,
            'course' => $course,
        ]);


    }

    public function store(Request $request)
    {

        $pathToFile = $request->file('video_url')->store('media');

       $lesson = Lesson::create([
            'module_id' => $request->input('module_id'),
            'title' => $request->input('title'),
            'video_url' => $pathToFile
        ]);

        if ($lesson) {
            $lesson->addMedia($pathToFile);
        } else {
            // Tratar o erro de criação da lição aqui
        }

        return redirect()->back();
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
