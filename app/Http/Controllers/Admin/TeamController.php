<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function show()
    {
        return inertia('Admin/Account/Team/Show');

    }
}
