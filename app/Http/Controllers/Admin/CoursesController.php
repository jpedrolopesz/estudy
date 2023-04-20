<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Course\CreateCourseAction;
use App\Actions\Course\GetAllCoursesAction;

use App\Actions\User\GetAllUsersAction;
use App\Data\Course\CreateCourseData;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
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
    public function store(CreateCourseData $data)
    {

        $course = CreateCourseAction::run($data);

        return Redirect::route('courses.index', $course);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses  $courses
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
        return Inertia::render('Admin/Course/Show', [
            'course' => $course,
            'lesson' => $lessonCount,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function edit($id)
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


        return Inertia::render('Admin/Course/Edit', [
            'course' => $course,
            'lesson' => $lessonCount,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses  $courses
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
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $courses)
    {
    }

    public function markAsWatched(Request $request, $lessonId)
    {
        $video = Lesson::find($lessonId);

        if (!$video) {
            abort(404, 'Vídeo não encontrado.');
        }

        // Atualiza o tempo assistido no vídeo
        $video->time_watched = $request->input('time_watched');
        $video->save();

        // Verifica se o tempo assistido é maior que 30 segundos e atualiza o registro de visualização do vídeo
        if ($video->time_watched >= 30) {
            $video->watched = true;
            $video->save();
        }

        return response()->json(['success' => true]);
    }


    /**
     * @return Response
     *
     * @throws AuthorizationException
     */
    public function overview(Request $request, Course $course)
    {

    }

}
