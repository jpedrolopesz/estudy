<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Course\GetAllCoursesAction;
use App\Actions\Course\GetCourseShowAction;
use App\Actions\User\GetAllUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index(): \Inertia\Response
    {
        $course = GetAllCoursesAction::run(['perPage' => 10000]);


        return Inertia::render('Admin/Course/Index', [
            'users' => UserResource::collection(GetAllUsersAction::run(['perPage' => 10000])),
            'courses' => CourseResource::collection($course),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $pathToFile = $request->file('thumbnail')[0]->storeImg('public', 'thumbnails');

        $course = Course::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'thumbnail' => $pathToFile,
        ]);

        if ($course) {
            $course->addMedia($pathToFile);
        } else {
            // Tratar o erro de criação da lição aqui
        }


        return redirect()->back();
    }

    public function show($id): \Inertia\Response
    {
        $course = Course::findOrFail($id);
        $lessonCount = 0;
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                $lessonCount++;
                $file = $lesson->files;
                $comments = $lesson->comments;
            }
        }
        return Inertia::render('Admin/Course/Modules/Index', [
            'course' => $course,
            'lesson' => $lessonCount,

        ]);
    }


    public function edit(int $id): \Inertia\Response
    {
        return Inertia::render('Admin/Course/EditAndCreate', [
            'course' => (new GetCourseShowAction())->execute($id),

        ]);
    }


    public function update(Request $request, $id): RedirectResponse
    {

        dd($request->all());
        $validatedData = $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $course = Course::find($id);

        if (!$course) {
            // Tratar o erro de curso não encontrado aqui
        }

        $course->title = $validatedData['title'];
        $course->description = $validatedData['description'];

        if ($request->hasFile('thumbnail')) {
            $pathToFile = $request->file('thumbnail')->store('public/thumbnails');
            $course->thumbnail = $pathToFile;
            $course->addMedia($pathToFile);
        }

        if ($course->save()) {
            // Tratar sucesso da atualização aqui
        } else {
            // Tratar erro de atualização aqui
        }

        return redirect()->back();
    }

}
