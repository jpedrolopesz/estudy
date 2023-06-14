<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\CreateUpdateLessonRequest;
use App\Jobs\UploadVideo;
use App\Models\{ Course, Module, Lesson};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $video = $request->file('video_url');
        $filename = time() . '.' . $video->getClientOriginalExtension();
        $videoPath = 'videos/' . $filename;

        Storage::disk('public')->putFileAs('', $video, $videoPath);

        $lesson = Lesson::create([
            'module_id' => $request->input('module_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_url' => $videoPath
        ]);

        UploadVideo::dispatch($lesson);

        if ($lesson) {
            $lesson->addMedia(public_path($videoPath));
        } else {
            return redirect()->back()->with('error', 'Error: Please check your request to resolve it efficiently.');
        }

        return redirect()->route('course.edit', $course)->with('success', 'Your request has been successfully completed.');
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




    public function update(CreateUpdateLessonRequest $request, Course $course, Module $module,  Lesson $lesson)
    {
        $video = $request->file('video_url');

        if ($video) {
            $filename = time() . '.' . $video->getClientOriginalExtension();
            $videoPath = 'videos/' . $filename;

            Storage::disk('public')->putFileAs('', $video, $videoPath);

            if ($lesson->video_url) {
                // Remover o vídeo antigo
                Storage::disk('public')->delete($lesson->video_url);
            }

            $lesson->video_url = $videoPath;
        }

        $lesson->module_id = $request->input('module_id');
        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->save();

        UploadVideo::dispatch($lesson);

        if ($video && !$lesson->addMedia(public_path($videoPath))) {
            return redirect()->back()->with('error', 'Error: Please check your request to resolve it efficiently.');
        }

        return redirect()->back()->with('success', 'Your request has been successfully completed.');
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
