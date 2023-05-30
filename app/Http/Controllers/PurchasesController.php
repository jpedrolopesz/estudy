<?php

namespace App\Http\Controllers;

use App\Actions\User\ShowSubscribedCourseAction;
use Inertia\Inertia;

class PurchasesController extends Controller
{

    public function index()
    {

    }

    public function showCourse(int $id): \Inertia\Response
    {
        return Inertia::render('User/Purchases/Course/ShowCourse', [
            'course' => (new ShowSubscribedCourseAction())->execute($id),
        ]);

    }
}
