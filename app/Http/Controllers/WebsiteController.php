<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class WebsiteController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Home/Welcome');
    }
}
