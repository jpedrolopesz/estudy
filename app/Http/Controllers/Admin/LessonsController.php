<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\CreateUpdateLessonRequest;
use App\Models\{ Course, Module, Lesson};
use Illuminate\Support\Facades\Redirect;
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

    public function store(CreateUpdateLessonRequest $request, Course $course)
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
            return Redirect::route()->with('error', 'Error: Please check your request to resolve it efficiently.');
        }


        return Redirect::route('course.edit', $course)
            ->with('success', 'Your request has been successfully completed.');    }

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

        return Redirect::back()->with('success', 'Your request has been successfully completed.');

    }

    public function destroy(string $course, string $module, string $lesson)
    {
        $course = Course::find($course);
        $module = optional($course)->modules()->find($module);
        $lesson = optional($module)->lessons()->find($lesson);

        if ($lesson) {
            $lesson->delete();
            return Redirect::back()->with('success', 'Your request has been successfully completed.');
        } else {
            // O curso, módulo ou lição não foram encontrados ou não existem
            // Trate o erro ou faça o redirecionamento adequado
        }
    }
}
