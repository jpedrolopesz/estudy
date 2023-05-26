<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Course\GetAllCoursesAction;
use App\Actions\Course\ShowCourseAction;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\CourseResource;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index(): \Inertia\Response
    {
        $course = GetAllCoursesAction::run(['perPage' => 10000]);

        return Inertia::render('Admin/Course/Index', [
            'courses' => CourseResource::collection($course),
            'course' => Course::with('modules')->get(),
            'filters' => Course::query(),

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
            return redirect()->back()->with('error', 'Error: Please check your request to resolve it efficiently.');
        }


        return Redirect::route('course.edit', $course)
            ->with('success', 'Your request has been successfully completed.');
    }

    public function show($id): \Inertia\Response
    {
        return Inertia::render('User/Course/Show', [
            'course' => (new ShowCourseAction())->execute($id),

        ]);
    }


    public function edit(int $id): \Inertia\Response
    {
        return Inertia::render('Admin/Course/EditAndCreate', [
            'course' => (new ShowCourseAction())->execute($id),

        ]);
    }


    public function update(Request $request, $id): RedirectResponse
    {


        $course = Course::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Error: Please check your request to resolve it efficiently.');
        }

        $course->fill($request->all());
        $course->save();


        return redirect()->back()->with('success', 'Your request has been successfully completed.');
    }

    public function destroy(string $id)
    {
        $course = Course::find($id);
        if ($course && $course->exists()) {
            $course->delete();
            return redirect()->back()->with('success', 'Your request has been successfully completed.');

        } else {
            return redirect()->back()->with('error', 'Error: Please check your request to resolve it efficiently.');

        }
    }

}
