<?php

namespace App\Http\Controllers\User;

use App\Actions\User\ShowSubscribedCourseAction;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUserView;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseUserController extends Controller
{

    public function index(): \Inertia\Response
    {
        $courses = Course::with('modules')
            ->join('users', 'courses.user_id', '=', 'users.id')
            ->select('courses.*', 'users.first_name', 'users.photo')
            ->get();

        $showCourseAction = new ShowSubscribedCourseAction();

        foreach ($courses as $course) {
            $courseData = $showCourseAction->execute($course->id);
            $course->progressPercentage = $courseData['progressPercentage'];
        }
        return Inertia::render('User/Course/Index', [
            'courses' => $courses,
        ]);
    }

    public function showCourse(int $id): \Inertia\Response
    {

        $courseData = (new ShowSubscribedCourseAction())->execute($id);

        return Inertia::render('User/Course/ShowCourse', [
            'course' => $courseData['course'],
        ]);

    }

    public function markAsWatched(Request $request, $id): RedirectResponse
    {
        $user = Auth::user();
        $userId = $user->id;

        $lessonUserView = LessonUserView::where('user_id', $userId)->where('lesson_id', $id)->first();

        if ($lessonUserView) {
            $lessonUserView->watched = !$lessonUserView->watched;
            $lessonUserView->save();
        } else {
            LessonUserView::create([
                'user_id' => $userId,
                'lesson_id' => $id,
                'watched' => true,
            ]);
        }
        return back();
    }







}
