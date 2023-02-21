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
           'course' => $courses
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
        $moduleCount = $course->modules->count();
        $lessonCount = 0;
        foreach ($course->modules as $module) {
            $lessonCount += $module->lessons->count();
        }

        return Inertia::render('User/Course/Show', [
            'course' => $course,
            'module' => $moduleCount,
            'lesson' => $lessonCount,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $courses)
    {
        //
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
