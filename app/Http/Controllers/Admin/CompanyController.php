<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function show()
    {
        return inertia('Admin/Account/Company/Show');

    }
}
