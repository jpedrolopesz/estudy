<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Inertia\Inertia;

class WebsiteController extends Controller
{
    public function index()
    {

        return Inertia::render('Welcome',[

            'courses' => Course::with('modules')->get(),
        ]);
    }
}
