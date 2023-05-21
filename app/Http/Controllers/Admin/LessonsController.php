<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\CreateUpdateLessonRequest;
use App\Models\{ Course, Module, Lesson};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LessonsController extends Controller
{
    public function create(int $id, Module $module): Response
    {
        $course = Course::with(['modules' => function ($query) {
            $query->orderBy('sort_order')->with(['lessons' => function ($query) {
                $query->orderBy('sort_order');
            }]);
        }])->findOrFail($id);

        return Inertia::render('Admin/Course/Lessons/Create', [
            'course' => $course,
            'module' => $module,
        ]);


    }

    public function store(CreateUpdateLessonRequest $request)
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

    public function edit(int $id, Module $module, Lesson $lesson): Response
    {
       $course = Course::with(['modules' => function ($query) {
            $query->orderBy('sort_order')->with(['lessons' => function ($query) {
                $query->orderBy('sort_order');
            }]);
        }])->findOrFail($id);


        return Inertia::render('Admin/Course/Lessons/Edit', [
            'course' => $course,
            'module' => $module,
            'lesson' => $lesson
        ]);
    }




    public function update(CreateUpdateLessonRequest $request, Course $course, Module $module, Lesson $lesson)
    {
        $lesson->update($request->all());

        return back();

    }

    public function destroy(string $id)
    {
        //
    }
}
