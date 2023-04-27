<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Course\CreateCourseAction;
use App\Actions\Course\GetAllCoursesAction;
use App\Actions\Course\GetCourseModulesLessonsAction;
use App\Actions\Course\GetCourseShowAction;
use App\Actions\Modules\GetAllModulesAction;
use App\Actions\User\GetAllUsersAction;
use App\Data\Course\CreateCourseData;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ModulesResource;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $course = GetAllCoursesAction::run(['perPage' => 10000]);


        return Inertia::render('Admin/Course/Index', [
            'users' => UserResource::collection(GetAllUsersAction::run(['perPage' => 10000])),
            'courses' => CourseResource::collection($course),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCourseData $data, Request $request, Course $course)
    {

        $courses = CreateCourseAction::run($data);

        return Redirect::route('courses.index', $courses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $courses
     * @return \Inertia\Response
     */
    public function show( $id)
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
        return Inertia::render('Admin/Course/Edit', [
            'course' => (new GetCourseShowAction())->execute($id),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $courses
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Module $module_id,$id)
    {

        $course = Course::find($id);

        $course->update([
            'title' => $request->input('title')
        ]);

        $module = $course->modules()->where('id', $module_id)->first();

        $module->update([
            'title' => $request->input('module_title')
        ]);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course $courses
     * @return Response
     */
    public function destroy(Course $courses)
    {
        //
    }


    /**
     * @return Response
     *
     * @throws AuthorizationException
     */
    public function overview(Request $request, Course $course)
    {
        //
    }

}
