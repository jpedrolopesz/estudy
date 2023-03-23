<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(User $user)
    {
        $courses = Course::get();

        return Inertia::render('User/Course/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'role', 'trashed'),
            'courses' => Course::get()
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return Inertia::render('User/Course/Show', [
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
        return Inertia::render('User/Course/Edit', [
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
    public function update(Request $request,$id)
    {
        $course = Course::find($id);
        $course->title = $request->title;
        $course->save();

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

}
