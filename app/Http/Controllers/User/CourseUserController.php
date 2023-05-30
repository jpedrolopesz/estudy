<?php

namespace App\Http\Controllers\User;

use App\Actions\User\ShowSubscribedCourseAction;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Inertia\Inertia;

class CourseUserController extends Controller
{

    public function index(): \Inertia\Response
    {
        return Inertia::render('User/Course/Index',[
            'courses' => Course::with('modules')->get(),
        ]);

    }

    public function showCourse(int $id): \Inertia\Response
    {
        return Inertia::render('User/Course/ShowCourse', [
            'course' => (new ShowSubscribedCourseAction())->execute($id),
        ]);

    }
}
