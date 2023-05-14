<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Module\CreateModuleAction;
use App\Actions\Module\GetAllModulesShowAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateModuleRequest;
use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
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
        $filename = uniqid() . '.' . $request->file('video_url')->getClientOriginalExtension();
        $pathToFile = $request->file('video_url')->store('videos', $filename);


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

    public function edit($module_id, $course_id, $lesson_id)
    {
        return Inertia::render('Admin/Course/Lessons/Edit', [
            'course' => Course::find($course_id),
            'module' => Module::find($module_id),
            'lesson' => Lesson::find($lesson_id)
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
